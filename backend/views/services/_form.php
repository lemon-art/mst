<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\date\DatePicker;
use dosamigos\fileupload\FileUpload;
/* @var $this yii\web\View */
/* @var $model app\models\Services */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<hr>
	<h2>Блок на главной странице</h2>
	
   <?= $form->field($model, 'image')->fileInput(); ?>

   <?= $form->field($model, 'title_main')->textInput(['maxlength' => true]) ?>
   
   <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview_text_main')->textarea(['rows' => 6]) ?>
	
	
	<?= $form->field($model, 'top_text')->textarea(['rows' => 3]) ?>

	
	<?=  $form->field($model, 'advantages')->widget(CKEditor::className(),[
		'editorOptions' => [
			'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
			'inline' => false, //по умолчанию false
		],
	]);?>
	
	<?=  $form->field($model, 'scheme')->widget(CKEditor::className(),[
		'editorOptions' => [
			'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
			'inline' => false, //по умолчанию false
		],
	]);?>
	
	<?=  $form->field($model, 'text_main')->widget(CKEditor::className(),[
		'editorOptions' => [
			'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
			'inline' => false, //по умолчанию false
		],
	]);?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>

	 
	<hr>
	 
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
