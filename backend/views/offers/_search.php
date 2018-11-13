<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OffersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bank_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'min_summ') ?>

    <?= $form->field($model, 'max_summ') ?>

    <?php // echo $form->field($model, 'min_term') ?>

    <?php // echo $form->field($model, 'max_term') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'min_age') ?>

    <?php // echo $form->field($model, 'max_age') ?>

    <?php // echo $form->field($model, 'preview_text') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
