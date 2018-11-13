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

		<div class="title">Регистрация</div>

		<div class="form">
			<?php $form = ActiveForm::begin([
				'id'                     => 'registration-form',
				'action'                 => Url::to(['/user/registration/register']),
				'enableAjaxValidation'   => true,
				'enableClientValidation' => false,
				'validateOnBlur'         => false,
				'validateOnType'         => false,
				'validateOnChange'       => false,
			]) ?>
			
				<div class="line_form">
					<?= $form->field($model, 'email')->textInput(['placeholder' => 'Электронная почта', 'class' => 'input']) ?>
				</div>

				<div class="line_form">
					<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль', 'class' => 'input']) ?>
				</div>

				<div class="submit">
					<?= Html::submitButton(Yii::t('user', 'Регистрация'), ['class' => 'submit_btn']) ?>
				</div>

				
				<div class="forgot">
					<a href="#modal_login" class="modal_link">Авторизация</a>
				</div>
				
			<?php ActiveForm::end(); ?>
		</div>

   

<?php endif ?>
