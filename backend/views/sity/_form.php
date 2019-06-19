<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dec1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dec2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dec3')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'dec4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subdomain')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
