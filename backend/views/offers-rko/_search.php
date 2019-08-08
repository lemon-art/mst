<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OffersRkoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offers-rko-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'activ') ?>

    <?= $form->field($model, 'special') ?>

    <?= $form->field($model, 'main_page') ?>

    <?php // echo $form->field($model, 'bank_id') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'preview_text') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'rko_service') ?>

    <?php // echo $form->field($model, 'rko_open') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
