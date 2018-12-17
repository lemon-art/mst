<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

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

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
