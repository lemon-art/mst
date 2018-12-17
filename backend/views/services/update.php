<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = 'Обновить услугу: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="services-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
