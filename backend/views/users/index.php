<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
			'username',
			'profile.last_name',
			'profile.name',
			'profile.second_name',
			'profile.phone',
            [
				'class' => \yii\grid\ActionColumn::className(),
				'template'=>'{delete}',
			]
        ],
    ]); ?>
</div>
