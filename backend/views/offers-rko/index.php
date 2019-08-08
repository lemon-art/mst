<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OffersRkoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offers Rkos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-rko-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Offers Rko', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'rko_service',
            //'rko_open',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
