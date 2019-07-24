<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Banks;

/* @var $this yii\web\View */
/* @var $model app\models\CreditFilter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-filter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'top_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_text')->textInput(['maxlength' => true]) ?>

    <?php $items = ArrayHelper::map(Banks::find()->all(), 'id', 'name'); array_unshift($items, ""); ?>
    <?= $form->field($model, 'bank_id')->dropdownList($items); ?>

    <?= $form->field($model, 'term')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
