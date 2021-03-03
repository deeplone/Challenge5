<?php

namespace backend\controllers;

use Yii;
use backend\models\EprRbtHot;
use backend\models\EprRbtHotSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RbtHotController implements the CRUD actions for EprRbtHot model.
 */
class RbtHotController extends Controller {

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
     * Lists all EprRbtHot models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EprRbtHotSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EprRbtHot model.
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
     * Creates a new EprRbtHot model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new EprRbtHot();

        if ($model->load(Yii::$app->request->post())) {
            $model->audio_path = \yii\web\UploadedFile::getInstance($model, 'audio_path');
            $model->img_path = \yii\web\UploadedFile::getInstance($model, 'img_path');
            if ($audio_path = $model->upload('audio_path')) {
                $model->audio_path = "$audio_path";
            }
            if ($img_path = $model->upload('img_path')) {
                $model->img_path = "$img_path";
            }
            if ($model->save()) {
                \Yii::$app->session->setFlash('success', 'Thêm mới thành công!');
                return $this->redirect(['index']);
            } else {
                \Yii::$app->session->setFlash('error', 'Thêm mới thất bại!');
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing EprRbtHot model.
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
     * Deletes an existing EprRbtHot model.
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
     * Finds the EprRbtHot model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EprRbtHot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = EprRbtHot::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
