<?php

namespace backend\controllers;

use Yii;
use backend\models\Orders;
use backend\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Kredit;
use backend\models\Ipoteka;
use backend\models\Debet;
use backend\models\DebetCards;
use backend\models\Avtokredit;
use backend\models\KreditKards;
use backend\models\Rko;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
	
		$model = $this->findModel($id);
		$order_id = $model->order_id;
	
		switch ( $model->service_id ) {
		
			case 1:
				$orderModel = Kredit::findOne($order_id);
				$arFields = Kredit::GetShowFields();
				break;
			case 2:
				$orderModel = Ipoteka::findOne($order_id);
				$arFields = Ipoteka::GetShowFields();
				break;			
			case 3:
				$orderModel = Debet::findOne($order_id);
				$arFields = Debet::GetShowFields();
				break;
			case 4:
				$orderModel = Avtokredit::findOne($order_id);
				$arFields = Avtokredit::GetShowFields();
				break;	
			case 5:
				$orderModel = KreditKards::findOne($order_id);
				$arFields = KreditKards::GetShowFields();
				break;	
			case 6:
				$orderModel = DebetCards::findOne($order_id);
				$arFields = DebetCards::GetShowFields();
				break;	
			case 7:
				$orderModel = Rko::findOne($order_id);
				$arFields = Rko::GetShowFields();
				break;	
				
		}
	
	
        return $this->render('view', [
			'model' => $model,
            'orderModel' => $orderModel,
			'arFields' => $arFields
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
	 

	 
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
