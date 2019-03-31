<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\date\DatePicker;
use dosamigos\fileupload\FileUpload;
use backend\models\Files;
/* @var $this yii\web\View */
/* @var $model app\models\Services */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

			<hr>
			<h2>Блок на главной странице</h2>
	
   						
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('image');?></label>
							<br>
							<?if ( $model->image ):?>
								<?=Html::img(Files::getPath($model->image),[
									'style' => 'width:150px;'
								]);?>
								<br><br>
							<?endif;?>
							
							<?= $form->field($model, 'image')->fileInput()->label(false);?>
						</div>	
   
   
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('big_image');?></label>
							<br>
							<?if ( $model->big_image ):?>
								<?=Html::img(Files::getPath($model->big_image),[
									'style' => 'width:150px;'
								]);?>
								<br><br>
							<?endif;?>
							
							<?= $form->field($model, 'big_image')->fileInput()->label(false);?>
						</div>	


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
	<h2>СЕО</h2>
	
	<div class="form-group">
		<label for="exampleInputEmail1"><?=$model->getAttributeLabel('seo_text');?></label>
		<?=  $form->field($model, 'seo_text')->widget(CKEditor::className(),[
			'editorOptions' => ElFinder::ckeditorOptions('elfinder')
		])->label(false);?>
	</div>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

	<?if ( $model->id == 1 ):?>
		<hr>
		<h2>На главной странице в шапке</h2> 
		
		<?= $form->field($model, 'text_main_title')->textInput(['maxlength' => true]) ?>
		
		<?= $form->field($model, 'text_main_text')->textInput(['maxlength' => true]) ?>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1"><?=$model->getAttributeLabel('text_main_img');?></label>
			<br>
			<?if ( $model->text_main_img ):?>
				<?=Html::img(Files::getPath($model->text_main_img),[
						'style' => 'width:150px;'
				]);?>
				<br><br>
			<?endif;?>
								
			<?= $form->field($model, 'text_main_img')->fileInput()->label(false);?>
		</div>	
		
	<?endif;?>	
	<hr>
	 
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
