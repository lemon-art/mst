<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>


		<section class="contact_form sectionMarg">
			<div class="cont">
				<div class="main_title">Оставьте свой телефон и мы с Вами свяжемся!</div>


				<div class="form">
					<?php Pjax::begin([
						'id' => 'requestFormPjax',
						'timeout' => false,
						'enablePushState' => true,
						'enableReplaceState' => true,
					]); ?>
					
						<?php if (Yii::$app->session->hasFlash('requestFormSubmitted')): ?>
							<div class="alert alert-success">
								Спасибо за обращение к нам. Мы постараемся ответить вам как можно скорее.
							</div>
						<?php elseif (Yii::$app->session->hasFlash('requestFormFalse')) : ?>
							<div class="alert alert-warning">
								Произошла ошибка при отправке сообщения!
							</div>
						<?php else: ?>
					
							<?php $form = ActiveForm::begin([
								'id' => 'request-form',
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

								<div class="line_flex">
									<div class="checkbox agree form-group field-request-agree required">
										<input type="checkbox" id="request-agree-body" class="form-control" name="request[agree]" value="1" uncheckvalue="1" checked aria-required="true"><label class="control-label" for="ipoteka-agree">Я даю свое согласие на обработку персональных данных</label><div class="help-block"></div>
									</div>
								</div>
								
								<?= $form->field($model, 'type')->textInput(['type' => 'hidden', 'value' => 'indexPage'])->label(false);?>

								<div class="submit">
									 <?= Html::submitButton('Отправить заявку', ['class' => 'submit_btn']) ?>
								</div>
								
							<?php ActiveForm::end(); ?>
							
						<?endif;?>	
					<?php Pjax::end(); ?>
				</div>
			</div>
		</section>
		
		


