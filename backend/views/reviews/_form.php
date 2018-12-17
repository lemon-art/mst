<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use backend\models\Files;
/* @var $this yii\web\View */
/* @var $model app\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>



	<div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
			<div class="box box-primary">
			
				<?php $form = ActiveForm::begin(); ?>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('name');?></label>
							<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('text');?></label>
							<?=  $form->field($model, 'text')->widget(CKEditor::className(),[
								'editorOptions' => [
									'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
									'inline' => false, //по умолчанию false
								],
							])->label(false);?>
						</div>
						
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
							<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
						</div>
						
					</div>
			</div>
		</div>
			
		<?php ActiveForm::end(); ?>

	</div>
