<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Действующие Api';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-index">



    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
				'attribute' => 'service_id',
				'format' => 'raw',
				'value' => function($model){
					return Html::a($model->services->name,['update', 'id' => $model->id]);
				},
			],
            [
				'attribute' => 'bank_id',
				'format' => 'raw',
				'value' => function($model){
					return Html::a($model->banks->name,['update', 'id' => $model->id]);
				},
			],
            [
				'class' => \yii\grid\ActionColumn::className(),
				'template'=>'{delete}',
			]
        ],
    ]); ?>
</div>
