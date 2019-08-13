<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OffersCreditcardsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кредитные карты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-creditcards-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить кредитную карту', ['create'], ['class' => 'btn btn-success']) ?>
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
            'rate',
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
                    if ($model->priority >= 2){
                        return 'Высокий';
                    } elseif ($model->priority == 1) {
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
