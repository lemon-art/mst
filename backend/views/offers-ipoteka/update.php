<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OffersIpoteka */

$this->title = 'Изменить ипотеку: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ипотека', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="offers-ipoteka-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
