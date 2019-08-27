<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OffersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Предложения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить предложение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'name',
				'format' => 'raw',
				'value' => function($model){
					return Html::a($model->name,['update', 'id' => $model->id]);
				},
			],
			[
				'attribute' => 'activ',
				'format' => 'raw',
				'options' => ['style' => 'width: 65px; max-width: 65px;'],
				'value' => function($model){
					if ( $model->activ ){
						return 'да';
					}
					else {
						return 'нет';
					}
				},
			],
            [
				'attribute' => 'bank_id',
				'value' => function($model){
					return $model->banks->name;
				}
			],  
			[
				'attribute' => 'service_id',
				'value' => function($model){
					return $model->services->name;
				}
			], 
            
			[
				'attribute' => 'special',
				'format' => 'raw',
				'value' => function($model){
					if ( $model->special ){
						return 'Да';
					}
					else
						return false;
					
				},
			],
            [
				'class' => \yii\grid\ActionColumn::className(),
				'template'=>'{delete}',
			]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
