<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OffersCreditcardsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offers Creditcards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-creditcards-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Offers Creditcards', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'grace_period',
            //'min_summ_kreditcard',
            //'max_summ_kreditcard',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
