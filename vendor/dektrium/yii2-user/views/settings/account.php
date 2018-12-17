<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\SettingsForm $model
 */

$this->title = Yii::t('user', 'Смена пароля');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>


		<section class="sectionMarg">
			<div class="cont">
				<!-- Боковая колонка -->
				<aside class="aside_left left">
					<div class="title ic_profile">Мой профиль <a href="/user/settings/profile"></a></div>

					<div class="profile">
						<div class="name"><b><?=$modelUser->last_name?></b> <?=$modelUser->name?> <?=$modelUser->second_name?></div>

						<div class="date"><?=$modelUser->display_bithday?></div>
					
						<br>
						<center><a href="/user/settings/account">Сменить пароль</a></center>
						<br>
						<?= Html::a(Yii::t('user', 'Logout'), ['/user/security/logout'], [
								'class'       => 'btn btn-danger btn-block',
								'data-method' => 'post'
						]) ?>
					</div>	
						
					
				</aside>
				<!-- End Боковая колонка -->
				

				<section class="section_center right">
					<div class="title_small"><?= Html::encode($this->title) ?></div>

					
					<?php $form = ActiveForm::begin([
						'id' => 'account-form',
						'options' => ['class' => 'form-horizontal'],
						'fieldConfig' => [
							'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
							'labelOptions' => ['class' => 'col-lg-3 control-label'],
						],
						'enableAjaxValidation' => true,
						'enableClientValidation' => false,
					]); ?>
						<div class="line_flex form ">
				
							<div class="line_form">
								<label><?=$model->getAttributeLabel('current_password');?></label>
								<?= $form->field($model, 'current_password')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('current_password'), 'class' => 'input'])->label(false);?>
							</div>
							<hr/>
							<div class="line_form">
								<label><?=$model->getAttributeLabel('new_password');?></label>
								<?= $form->field($model, 'new_password')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('new_password'), 'class' => 'input'])->label(false);?>
							</div>
				
				
							<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'submit_btn order_submit']) ?>
					
						</div>

					<?php ActiveForm::end(); ?>
					
					
				</section>
				<div class="clear"></div>
			</div>
		</section>

