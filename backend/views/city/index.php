<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Города';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sity-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить город', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'dec1',
            'dec2',
            'dec3',
			'dec4',
            'subdomain',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
