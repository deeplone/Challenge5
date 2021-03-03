<?php

namespace backend\controllers;

use Yii;
use backend\models\EnterpriseFile;
use backend\models\EnterpriseFileSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileController implements the CRUD actions for EnterpriseFile model.
 */
class ProfileController extends AppController {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all EnterpriseFile models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EnterpriseFileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all EnterpriseFile models.
     * @return mixed
     */
    public function actionRecord() {
        $searchModel = new EnterpriseFileSearch();
        $searchModel->requires_recording = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('record', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all EnterpriseFile models.
     * @return mixed
     */
    public function actionCp() {
        $searchModel = new EnterpriseFileSearch();
        //$searchModel->requires_recording = 4;
        $dataProvider = $searchModel->searchCp(Yii::$app->request->queryParams);

        return $this->render('cp', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpload($id) {
        $this->layout = false;
        if ($post = \Yii::$app->request->post()) {
            $model = $this->findModel($id);
            $fileUpload['name']['recording_file'] = $_FILES['file']['name'];
            $fileUpload['tmp_name']['recording_file'] = $_FILES['file']['tmp_name'];
            $fileUpload['type']['recording_file'] = $_FILES['file']['type'];
            $fileUpload['size']['recording_file'] = $_FILES['file']['size'];
            $fileUpload['error']['recording_file'] = $_FILES['file']['error'];
            if ($file = $model->uploadMp3('recording_file', $fileUpload)) {
                $model->recording_file = "$file";
                $model->status = 1;
                if ($model->save(false, ['recording_file', 'status'])) {
                    $mtcontent = Yii::$app->params['upload_file_thu_am'];
                    \common\helpers\SendMT::sendMT($model->enterprise->msisdn, $mtcontent);
                    Yii::$app->session->setFlash('success', 'Upload file ghi âm thành công!');
                    return json_encode(['error' => 0, 'message' => 'Successful!']);
                }
            } else {
                return json_encode(['error' => 1, 'message' => $model->getErrors('recording_file')]);
            }
        }
        return json_encode(['error' => 1, 'message' => 'Có lỗi xảy ra! Vui lòng thực hiện lại sau ít phút!']);
    }

    /**
     * Displays a single EnterpriseFile model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EnterpriseFile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new EnterpriseFile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing EnterpriseFile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $status = $model->status;
        $recordingFile = EnterpriseFile::getRelatedRecordingFile($model->relate_id);
        $files = $_FILES[$model->formName()];

        if ($model->load(Yii::$app->request->post())) {
            if ($model->status == 4 && !$model->reason) {
                $model->status = $status;
                $model->addError('reason', 'Bạn chưa nhập lý do từ chối phê duyệt');
            } else {
                $model->updated_by = \Yii::$app->user->getId();
                switch ($model->status) {
                    case 4:
                        $model->status = 4;
                        $model->save(false, ['status', 'reason', 'updated_by']);
                        Yii::$app->session->setFlash('success', 'Từ chối duyệt thành công!');
                        $mtcontent = str_replace('<#id#>', \common\helpers\Helpers::eprCode($model->id), Yii::$app->params['tu_choi_duyet']);
                        \common\helpers\SendMT::sendMT($model->enterprise->msisdn, $mtcontent);
                        break;
                    case 6:
                        if ($model->recording_file) {
                            if (is_file(\Yii::getAlias('@frontend_upload') . $model->recording_file)) {
                                if ($model->genToneCode()) {
                                    $model->status = 6;
                                    $model->save(false, ['status', 'reason', 'updated_by']);
                                    $model->mp3ToWav(\Yii::getAlias('@frontend_upload') . $model->recording_file);
                                    $model->pushFTP();
                                    Yii::$app->session->setFlash('success', 'Tạo nhạc chờ trên vcrbt thành công!');
                                } else {
                                    Yii::$app->session->setFlash('error', 'Không tạo được nhạc chờ trên vcrbt!');
                                }
                            } else {
                                Yii::$app->session->setFlash('error', 'File thu âm không tồn tại!');
                            }
                        } else {
                            Yii::$app->session->setFlash('error', 'Hồ sơ chưa có file thu âm!');
                        }
                        break;
                    case 3:
                        if ($model->recording_file) {
                            if (is_file(\Yii::getAlias('@frontend_upload') . $model->recording_file)) {
                                if ($model->genToneCode()) {
                                    $model->save(false, ['status', 'reason', 'updated_by']);
                                    $model->mp3ToWav(\Yii::getAlias('@frontend_upload') . $model->recording_file);
                                    $model->pushFTP();
                                    //Yii::$app->session->setFlash('success', 'Tạo nhạc chờ trên vcrbt thành công!');
                                    if (sizeof($model->rbt)) {
                                        $model->status = 3;
                                        $model->crbt();
                                        $model->save(false, ['status', 'reason', 'updated_by']);
                                        $mtcontent = str_replace('<#tone_code#>', $model->rbt->tone_code, str_replace('<#id#>', \common\helpers\Helpers::eprCode($model->id), Yii::$app->params['phe_duyet']));
                                        \common\helpers\SendMT::sendMT($model->enterprise->msisdn, $mtcontent);
                                        Yii::$app->session->setFlash('success', 'Phê duyệt hồ sơ thành công! Mã nhạc chờ là: ' .$model->rbt->tone_code);
                                    } else {
                                        Yii::$app->session->setFlash('error', 'Hồ sơ chưa tạo nhạc chờ!');
                                    }
                                } else {
                                    Yii::$app->session->setFlash('error', 'Không tạo được nhạc chờ trên vcrbt!');
                                }
                            } else {
                                Yii::$app->session->setFlash('error', 'File thu âm không tồn tại!');
                            }
                        } else {
                            Yii::$app->session->setFlash('error', 'Hồ sơ chưa có file thu âm!');
                        }
                        break;
                    default :
                        $model->save(false, ['status', 'reason', 'updated_by']);
                        Yii::$app->session->setFlash('success', 'Cập nhật hồ sơ thành công!');
                        break;
                }
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        if($recordingFile) {
            return $this->render('update', [
                'model' => $model,
                'recording_file' => $recordingFile,
            ]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EnterpriseFile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EnterpriseFile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EnterpriseFile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = EnterpriseFile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
