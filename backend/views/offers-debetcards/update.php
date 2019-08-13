<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OffersDebetcards */

$this->title = 'Изменить дебетовую  карту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Дебетовые карты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="offers-debetcards-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
