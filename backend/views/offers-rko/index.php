<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OffersRkoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'РКО';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-rko-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить РКО', ['create'], ['class' => 'btn btn-success']) ?>
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
//            [
//                'attribute' => 'bank_id',
//                'value' => function($model){
//                    return $model->banks->name;
//                }
//            ],
            [
                'attribute' => 'rate',
                'format' => 'raw',
                'value' => function($model){
                    return $model->rate / 100;
                },
            ],
            [
                'attribute' => 'special',
                'format' => 'raw',
                'value' => function($model){
                    if ( $model->special ){
                        return 'да';
                    }
                    else
                        return false;

                },
            ],
            [
                'attribute' => 'sort',
                'format' => 'raw',
                'options' => ['style' => 'width: 80px; max-width: 80px;'],
                'value' => function($model){
                    if ($model->sort >= 2){
                        return 'Высокий';
                    } elseif ($model->sort == 1) {
                        return 'Средний';
                    } else {
                        return 'Низкий';
                    }
                },
            ],
            [
                'class' => \yii\grid\ActionColumn::className(),
                'template'=>'{delete}',
            ]
        ],
    ]); ?>
</div>
