<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
/**
 * @var yii\web\View                   $this
 * @var yii\widgets\ActiveForm         $form
 * @var dektrium\user\models\LoginForm $model
 * @var string                         $action
 */

?>



		<div class="title">Восстановление пароля</div>

		<div class="form">
		
			<?
					
			Pjax::begin([
				'id' => 'requestFotgorFormPjax',
				'timeout' => false,
				'enablePushState' => true,
				'enableReplaceState' => true,
			]); 
			?>			
		
				<?php $form = ActiveForm::begin([
					'id'                     => 'password-recovery-form',
					'action'                 => Url::to(['/user/forgot']),
					'enableAjaxValidation'   => true,
					'enableClientValidation' => false,
				]) ?>
				
					<div class="line_form">
						<?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Электронная почта', 'class' => 'input']) ?>
					</div>

					<div class="submit">
						<?= Html::submitButton(Yii::t('user', 'Восстановить'), ['class' => 'submit_btn']) ?>
					</div>
					
					<div class="forgot">
						<a href="#modal_login" class="modal_link">Авторизация</a>
					</div>
					
				<?php ActiveForm::end(); ?>
				
			<?php Pjax::end(); ?>
		</div>

   

