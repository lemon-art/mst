<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OffersDepositSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offers Deposits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-deposit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Offers Deposit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'activ',
            'bank_id',
            'name',
            'rate',
            //'preview_text:ntext',
            //'image',
            //'special',
            //'sort',
            //'main_page',
            //'depozit_term',
            //'depozit_summ',
            //'link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
