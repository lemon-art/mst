<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Banks */

$this->title = 'Добавить банк';
$this->params['breadcrumbs'][] = ['label' => 'Банки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->priority = 1; //средний приоритет по умолчанию
?>
<div class="banks-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
