<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OffersDeposit */

$this->title = 'Изменить депозит: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Депозиты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="offers-deposit-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
