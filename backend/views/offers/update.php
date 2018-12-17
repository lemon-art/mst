<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Offers */

$this->title = 'Редактирование: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Предложения', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование ';
?>

<div class="offers-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
