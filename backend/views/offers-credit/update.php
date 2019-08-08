<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OffersCredit */

$this->title = 'Update Offers Credit: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Offers Credits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="offers-credit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
