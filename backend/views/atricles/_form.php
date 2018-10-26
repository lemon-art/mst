<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\date\DatePicker;
use dosamigos\fileupload\FileUpload;

/* @var $this yii\web\View */
/* @var $model app\models\Atricles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atricles-form">
	<?php $form = ActiveForm::begin([
		'options' => ['enctype' => 'multipart/form-data']
		]); 
	?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'date')->widget(DatePicker::className(),[
		'value' => date('Y-m-d'),
		'options' => ['placeholder' => 'Select issue date ...'],
		'pluginOptions' => [
			'format' => 'yyyy-mm-dd',
			'todayHighlight' => true
		]
	]);?>
	
	<?= $form->field($model, 'image')->fileInput(); ?>
	
	
	
	

    <?= $form->field($model, 'preview_text')->textarea(['rows' => 6]) ?>
	
	
	<?=  $form->field($model, 'detail_text')->widget(CKEditor::className(),[
		'editorOptions' => [
			'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
			'inline' => false, //по умолчанию false
		],
	]);?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
