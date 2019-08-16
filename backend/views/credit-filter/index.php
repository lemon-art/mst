<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Banks;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CreditFilterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фильтры кредитов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-filter-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить ссылку и фильтр кредита', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            [
                'attribute' => 'url_name',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->url_name,['update', 'id' => $model->id]);
                },
            ],
            'title',
            'term',
            'summ',
            [
                'attribute' => 'rate',
                'format' => 'raw',
                'value' => function($model){
                    return $model->rate / 100;
                },
            ],
            'min_age',
            'max_age',
            [
                'class' => \yii\grid\ActionColumn::className(),
                'template'=>'{delete}',
            ]
        ],
    ]); ?>
</div>
