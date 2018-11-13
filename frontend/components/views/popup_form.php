<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>		
		
		<div class="title">Заказать обратный звонок</div>

		<div class="form">
		
			<?php Pjax::begin([
				'id' => 'requestPopupFormPjax',
				'timeout' => false,
				'enablePushState' => true,
				'enableReplaceState' => true,
			]); ?>
			
				<?php if (Yii::$app->session->hasFlash('requestPopupFormSubmitted')): ?>
					<div class="alert alert-success">
						Спасибо за обращение к нам. Мы постараемся ответить вам как можно скорее.
					</div>
				<?php elseif (Yii::$app->session->hasFlash('requestPopupFormFalse')) : ?>
					<div class="alert alert-warning">
						Произошла ошибка при отправке сообщения!
					</div>
				<?php else: ?>
			
					<?php $form = ActiveForm::begin([
						'id' => 'popup-form',
						'options' => ['data-pjax' => '1'],
					]); ?>
					
						<div class="line_flex">
									<div class="line_form">
										<label><?=$model->getAttributeLabel('name');?></label>
										<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'input'])->label(false);?>
									</div>

									<div class="line_form">
										<label><?=$model->getAttributeLabel('phone');?></label>
										<?= $form->field($model, 'phone')->textInput(['type' => 'tel', 'class' => 'input', 'placeholder' => '+7 (___)-___-__-__'])->label(false);?>
									</div>
						</div>
						
						<?= $form->field($model, 'type')->textInput(['type' => 'hidden', 'value' => 'callbackForm'])->label(false);?>


						<div class="submit">
							<?= Html::submitButton('Отправить заявку', ['class' => 'submit_btn']) ?>
						</div>
						
					<?php ActiveForm::end(); ?>
					
				<?endif;?>	
				
			<?php Pjax::end(); ?>
		
		
		</div>