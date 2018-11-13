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
					'attribute' => 'bank_id',
					'value' => function($model){
						return $model->banks->name;
					}
				],  
            
			'rate',
            'min_summ',
            'max_summ',
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
