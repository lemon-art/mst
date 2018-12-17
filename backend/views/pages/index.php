<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">


    <p>
        <?= Html::a('Добавить страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
				'attribute' => 'code',
				'format' => 'raw',
				'value' => function($model){
					return Html::a($model->code,['update', 'id' => $model->id]);
				},
			],
            
            'h1',
			'title',
            [
				'class' => \yii\grid\ActionColumn::className(),
				'template'=>'{delete}',
			]
        ],
    ]); ?>
</div>
