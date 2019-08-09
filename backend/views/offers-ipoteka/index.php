<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OffersIpotekaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ипотека';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-ipoteka-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить ипотеку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'activ',
            //'special',
            //'main_page',
            'bank_id',
            'rate',
            //'link',
            //'preview_text:ntext',
            //'image',
            'sort',
            //'initial_payment',
            //'min_summ_ipoteka',
            //'max_summ_ipoteka',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
