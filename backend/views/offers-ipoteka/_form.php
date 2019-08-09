<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OffersIpoteka */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offers-ipoteka-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activ')->textInput() ?>

    <?= $form->field($model, 'special')->textInput() ?>

    <?= $form->field($model, 'main_page')->textInput() ?>

    <?= $form->field($model, 'bank_id')->textInput() ?>

    <?= $form->field($model, 'rate')->textInput() ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->textInput() ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'initial_payment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_summ_ipoteka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_summ_ipoteka')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
