<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use backend\models\Files;
/* @var $this yii\web\View */
/* @var $model app\models\Pages */
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
							 <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
						</div>
						<div class="form-group">
							 <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>
						</div>
						<div class="form-group">
							 <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
						</div>
						<div class="form-group">
							<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('text');?></label>
							<?=  $form->field($model, 'text')->widget(CKEditor::className(),[
								'editorOptions' => ElFinder::ckeditorOptions('elfinder'),
							])->label(false);?>
						</div>
						

						
						<div class="form-group">
							<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
						</div>
						
					</div>
			</div>
		</div>
			
		<?php ActiveForm::end(); ?>

	</div>


