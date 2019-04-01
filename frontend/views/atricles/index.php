<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AtriclesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atricles';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="atricles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


</div>
