<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\date\DatePicker;
use dosamigos\fileupload\FileUpload;

/* @var $this yii\web\View */
/* @var $model app\models\Banks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
	<?=$form->field($model, 'active')->checkbox(array('value'=>1, 'uncheckValue'=>0), ['maxlength' => true, 'class' => 'form-control']);?>
	
	<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'image')->fileInput(); ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

	
	<?=  $form->field($model, 'preview_text')->widget(CKEditor::className(),[
		'editorOptions' => [
			'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
			'inline' => false, //по умолчанию false
		],
	]);?>
	
	

    <?= $form->field($model, 'adress')->textarea(['rows' => 6]) ?>

	
	<?=  $form->field($model, 'phone')->widget(CKEditor::className(),[
		'editorOptions' => [
			'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
			'inline' => false, //по умолчанию false
		],
	]);?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'license')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'foundation_date')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'priority')->textInput(['maxlength' => true])->dropDownList([
		'1' => 'Низкий',
		'2' => 'Средний',
		'3' => 'Высокий',
	]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
