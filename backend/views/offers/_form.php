<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Banks;
use backend\models\Services;
use mihaildev\ckeditor\CKEditor;
use backend\models\Files;
/* @var $this yii\web\View */
/* @var $model app\models\Offers */
/* @var $form yii\widgets\ActiveForm */
?>

	<div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Основные данные</h3>
				</div>
			
				<?php $form = ActiveForm::begin(); ?>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('name');?></label>
							<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('bank_id');?></label>
							<?= $form->field($model, 'bank_id')->dropDownList(Banks::GetList(), ['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('service_id');?></label>
							<?= $form->field($model, 'service_id')->dropDownList(Services::GetList(), ['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('rate');?></label>
							<?= $form->field($model, 'rate')->textInput(['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('min_summ');?></label>
							<?= $form->field($model, 'min_summ')->textInput(['maxlength' => true, 'class' => 'form-control summa'])->label(false);?>
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('max_summ');?></label>
							<?= $form->field($model, 'max_summ')->textInput(['maxlength' => true, 'class' => 'form-control summa'])->label(false);?>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('min_term');?></label>
							<?= $form->field($model, 'min_term')->textInput(['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('max_term');?></label>
							<?= $form->field($model, 'max_term')->textInput(['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('min_age');?></label>
							<?= $form->field($model, 'min_age')->textInput(['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('max_age');?></label>
							<?= $form->field($model, 'max_age')->textInput(['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						
						<div class="form-group">
							<?=$form->field($model, 'special')->checkbox(array('value'=>1, 'uncheckValue'=>0), ['maxlength' => true, 'class' => 'form-control']);?>
						</div>
						
						<div class="form-group">
							<?=$form->field($model, 'main_page')->checkbox(array('value'=>1, 'uncheckValue'=>0), ['maxlength' => true, 'class' => 'form-control']);?>
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('preview_text');?></label>
							<?=  $form->field($model, 'preview_text')->widget(CKEditor::className(),[
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
