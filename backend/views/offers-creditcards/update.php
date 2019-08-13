<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OffersCreditcards */

$this->title = 'Изменить: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кредитные карты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="offers-creditcards-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
