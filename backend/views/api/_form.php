<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Services;
use backend\models\Banks;
/* @var $this yii\web\View */
/* @var $model app\models\Api */
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
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('service_id');?></label>
							<?= $form->field($model, 'service_id')->dropDownList(Services::GetList(), ['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$model->getAttributeLabel('bank_id');?></label>
							<?= $form->field($model, 'bank_id')->dropDownList(Banks::GetList(), ['maxlength' => true, 'class' => 'form-control'])->label(false);?>
						</div>
						
						<div class="form-group">
							<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
						</div>
						
					</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>

