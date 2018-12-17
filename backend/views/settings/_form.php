<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

	<div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
			<div class="box box-primary">
				<div class="box-body">
					<?php $form = ActiveForm::begin(); ?>

					<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

					<?= $form->field($model, 'admin_email')->textInput() ?>

					<div class="form-group">
						<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
					</div>

					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
