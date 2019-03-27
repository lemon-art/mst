<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Брошенные заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lostorders-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'name',
            'phone',
			[
				'attribute' => 'Услуга',
				'format' => 'raw',
				'value' => 'services.name'
			],
            [
				'class' => \yii\grid\ActionColumn::className(),
				'template'=>'{delete}',
			]
        ],
    ]); ?>
</div>
