<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>		
		
		<div class="title">Помочь заполнить?</div>

		<div class="form">
		
			<?php Pjax::begin([
				'id' => 'requestPopupFormPjax',
				'timeout' => false,
				'enablePushState' => true,
				'enableReplaceState' => true,
			]); ?>
			
				<?php if (Yii::$app->session->getFlash('requestPopupFormSubmitted') == 'Y' ): ?>
					<div class="alert alert-success">
						Спасибо за обращение к нам. Мы постараемся ответить вам как можно скорее.
					</div>
					<?Yii::$app->session->setFlash('requestPopupFormSubmitted', 'N');?>
				<?php elseif (Yii::$app->session->hasFlash('requestPopupFormFalse')) : ?>
					<div class="alert alert-warning">
						Произошла ошибка при отправке сообщения!
					</div>
				<?php endif;?>
			
					<?php $form = ActiveForm::begin([
						'id' => 'popup-form',
						'options' => ['data-pjax' => '1'],
					]); ?>
					

						<div class="submit">
							<?= Html::submitButton('Заполню самостоятельно ', ['class' => 'close_popup submit_btn']) ?>
						</div>
						
						<div class="submit">
							<?= Html::submitButton('Требуется помощь оператора', ['class' => 'need_help_modal submit_btn']) ?>
						</div>
						
					<?php ActiveForm::end(); ?>
					
				
				
			<?php Pjax::end(); ?>
		
		
		</div>