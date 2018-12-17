<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
			[
				'attribute' => 'id',
				'format' => 'raw',
				'options' => ['style' => 'width: 65px; max-width: 65px;'],
				'value' => function($model){
					return Html::a($model->id,['view', 'id' => $model->id]);
				},
			],
			[
				'attribute' => 'fullName',
				'format' => 'raw',
				'value' => function($model){
					return Html::a($model->fullName,['view', 'id' => $model->id]);
				},
			],
			[
				'attribute' => 'summ',
				'format' => 'raw',
				'value' => function($model){
					return number_format($model->summ, 0, '', ' ');
				},
			],
			'term',
			'city',
            'phone',
            'email',
            //'summ',
            //'term',
            //'city',
            //'employment',
            //'work_month',
            //'work_year',
            //'income',
            //'provision',
            //'have_auto',
            //'service_id',
            //'user_id',

            [
				'class' => \yii\grid\ActionColumn::className(),
				'template'=>'{delete}',
			]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
