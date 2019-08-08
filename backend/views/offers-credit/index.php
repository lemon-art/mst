<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OffersCreditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offers Credits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-credit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Offers Credit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'activ',
            'special',
            'main_page',
            //'bank_id',
            //'rate',
            //'link',
            //'preview_text:ntext',
            //'image',
            //'sort',
            //'min_summ',
            //'max_summ',
            //'min_term',
            //'max_term',
            //'min_age',
            //'max_age',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
