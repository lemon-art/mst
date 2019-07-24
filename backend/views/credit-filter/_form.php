<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Banks;

/* @var $this yii\web\View */
/* @var $model app\models\CreditFilter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'top_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'term')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
