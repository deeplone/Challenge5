<?php

namespace backend\controllers;

use Yii;
use backend\models\ChargingLog;
use backend\models\ChargingLogSearch;
use backend\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChargingLogController implements the CRUD actions for ChargingLog model.
 */
class ChargingLogController extends AppController {

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
     * Lists all ChargingLog models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ChargingLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the ChargingLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ChargingLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ChargingLog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
