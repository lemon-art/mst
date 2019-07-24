<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-filter-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'dec1') ?>

    <?= $form->field($model, 'dec2') ?>

    <?= $form->field($model, 'dec3') ?>
	
	<?= $form->field($model, 'dec4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subdomain')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
