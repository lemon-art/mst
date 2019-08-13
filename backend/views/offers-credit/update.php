<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OffersCredit */

$this->title = 'Изменить кредит: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кредиты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="offers-credit-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
