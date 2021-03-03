<?php

namespace backend\controllers;

use Yii;
use backend\models\EprVoices;
use backend\models\EprVoicesSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VoicesController implements the CRUD actions for EprVoices model.
 */
class VoicesController extends AppController {

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
     * Lists all EprVoices models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EprVoicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EprVoices model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EprVoices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $models = EprVoices::find()->all();
        $model = sizeof($models) ? $models[0] : new EprVoices();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            ini_set('max_execution_time', 300); //300 seconds = 5 minutes
            set_time_limit(300);
            $voices = \common\libs\Voices::getFormat();
            if (sizeof($voices)) {
                EprVoices::deleteAll();
                foreach ($voices as $item) {
                    $fileVoice = \common\libs\Voices::getVoice($model->content, $item['code']);
                    if ($fileVoice) {
                        $temp = new EprVoices();
                        $temp->content = $model->content;
                        $temp->name = $item['name'];
                        $temp->description = $item['description'];
                        $temp->code = $item['code'];
                        $temp->path = $fileVoice;
                        $temp->save(false);
                    }
                }
            }
            return $this->redirect('index');
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing EprVoices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EprVoices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EprVoices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EprVoices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = EprVoices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPriorityUpdate()
    {
        $action = Yii::$app->request->post('action', '');
        $ids = Yii::$app->request->post('ids', '');
        $priority = Yii::$app->request->post('priority', '');
        if (!Yii::$app->getRequest()->validateCsrfToken()) {
            return Yii::t('backend', "CSRF TOKEN INVALID");
        }


        foreach ($ids as $k => $id) {
            $model = EprVoices::findOne(['id' => $id]);
            $model->priority = $priority[$k];
            $model->save(false, ['priority']);
        }
        Yii::$app->session->setFlash('success', Yii::t('backend', 'Xử lý thành công!'));

    }
}
