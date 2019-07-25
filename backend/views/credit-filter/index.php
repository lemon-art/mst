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
            'url_name',
            'title',
            [
                'attribute' => 'bank_id',
                'format' => 'raw',
                'value' => function($model){
                    if ($model->bank_id == 0){
                        return '';
                    } else {
                        $bank = Banks::find()->where(['id' => $model->bank_id])->one();
                        return $bank->name;
                    }
                },
            ],
			'term',
            'summ',
            'rate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
