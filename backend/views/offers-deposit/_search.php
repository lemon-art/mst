<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OffersDepositSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offers-deposit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activ') ?>

    <?= $form->field($model, 'bank_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'preview_text') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'special') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'main_page') ?>

    <?php // echo $form->field($model, 'depozit_term') ?>

    <?php // echo $form->field($model, 'depozit_summ') ?>

    <?php // echo $form->field($model, 'link') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
