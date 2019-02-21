<?php

namespace frontend\controllers;

use Yii;
use app\models\Atricles;
use app\models\AtriclesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AtriclesController implements the CRUD actions for Atricles model.
 */
class AtriclesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

 
    public function actionIndex()
    {
        $searchModel = new AtriclesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
		if ( !$model )
			throw new NotFoundHttpException;
		
		return $this->render('view', [
            'model' => $model,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Atricles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
