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
use dektrium\user\helpers\Timezone;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model
 */

$this->title = Yii::t('user', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>


		<section class="sectionMarg">
			<div class="cont">
				<!-- Боковая колонка -->
				<aside class="aside_left left">
					<div class="title ic_profile">Мой профиль <a href="/user/settings/profile"></a></div>

					<div class="profile">
						<div class="name"><b><?=$model->last_name?></b> <?=$model->name?> <?=$model->second_name?></div>

						<div class="date"><?=$model->display_bithday?></div>
					
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
						'id' => 'profile-form',
						'options' => ['class' => 'form-horizontal'],
						'fieldConfig' => [
							'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
							'labelOptions' => ['class' => 'col-lg-3 control-label'],
						],
						'enableAjaxValidation' => true,
						'enableClientValidation' => false,
						'validateOnBlur' => false,
					]); ?>

					<div class="line_flex form ">
					
						<div class="line_form">
							<label><?=$model->getAttributeLabel('last_name');?></label>
							<?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('last_name'), 'class' => 'input'])->label(false);?>
						</div>
						
						<div class="line_form">
							<label><?=$model->getAttributeLabel('name');?></label>
							<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name'), 'class' => 'input'])->label(false);?>
						</div>
						
						<div class="line_form">
							<label><?=$model->getAttributeLabel('second_name');?></label>
							<?= $form->field($model, 'second_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name'), 'class' => 'input'])->label(false);?>
						</div>
						
						<div class="line_form">
							<label><?=$model->getAttributeLabel('bithday');?></label>
							<?= $form->field($model, 'bithday')->widget(DatePicker::className(),[
								//'value' => date('Y-m-d'),
								'class' => 'input',
								'options' => ['placeholder' => 'Выберите дату'],
								'pluginOptions' => [
									'format' => 'dd.mm.yyyy',
									'todayHighlight' => true
								]
							])->label(false);?>
						</div>
						
						<div class="line_form">
							<label><?=$model->getAttributeLabel('phone');?></label>
							<?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('phone'), 'class' => 'input'])->label(false);?>
						</div>

						<div class="line_form">
							<label><?=$model->getAttributeLabel('location');?></label>
							<?= $form->field($model, 'location')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('location'), 'class' => 'input'])->label(false);?>
						</div>


						<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'submit_btn order_submit']) ?>
						<?= Html::button('Отмена', [ 'class' => 'submit_btn order_submit', 'onclick' => 'window.location.href = "/personal";' ]);?>
					</div>
					
					 


					<?php ActiveForm::end(); ?>
					
					
				</section>
				<div class="clear"></div>
			</div>
		</section>



