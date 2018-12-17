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

/**
 * @var yii\web\View                   $this
 * @var yii\widgets\ActiveForm         $form
 * @var dektrium\user\models\LoginForm $model
 * @var string                         $action
 */

?>

<?php if (Yii::$app->user->isGuest): ?>

		<div class="title">Вход</div>

		<div class="form">
			<?php $form = ActiveForm::begin([
				'id'                     => 'login-widget-form',
				'action'                 => Url::to(['/user/security/login']),
				'enableAjaxValidation'   => true,
				'enableClientValidation' => false,
				'validateOnBlur'         => false,
				'validateOnType'         => false,
				'validateOnChange'       => false,
			]) ?>
			
				<div class="line_form">
					<?= $form->field($model, 'login')->textInput(['placeholder' => 'Электронная почта', 'class' => 'input'])->label('Электронная почта') ?>
				</div>

				<div class="line_form">
					<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль', 'class' => 'input']) ?>
				</div>

				<div class="submit">
					<?= Html::submitButton(Yii::t('user', 'Войти на сайт'), ['class' => 'submit_btn']) ?>
				</div>

				<div class="forgot">
					<a href="#modal_forgot" class="modal_link">Забыли пароль?</a>
				</div>
				

				
			<?php ActiveForm::end(); ?>
		</div>

   

<?php endif ?>
