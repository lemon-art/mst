<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
$arYears = Array(''   => 'Выберите');
$year = date('Y');
for ( $i = 0; $i < 15; $i++){
	$arYears[$year - $i] = $year - $i;
}

?>	



		<section class="section_request sectionMarg" id="completed">
			<div class="cont">
				<div class="main_title">Заполните заявку</div>
				
				<div class="need_help right">
					<a href="/">Мне нужна помощь</a>
				</div>
				<div class="clear"></div>

				<div class="form">
				
					<?
					
					Pjax::begin([
						'id' => 'requestOrderFormPjax',
						'timeout' => false,
						'enablePushState' => true,
						'enableReplaceState' => true,
					]); 
					
					?>
				
					<?php if (Yii::$app->session->hasFlash('requestOrderFormSubmitted')): ?>
						<div class="alert alert-success">
							Спасибо за обращение к нам. Мы постараемся ответить вам как можно скорее.
						</div>
					<?php elseif (Yii::$app->session->hasFlash('requestOrderFormFalse')) : ?>
						<div class="alert alert-warning">
							Произошла ошибка при отправке сообщения!
						</div>
					<?php else: ?>
				
						<?php $form = ActiveForm::begin([
							'id' => 'order-form',
							'options' => ['data-pjax' => '1'],
						]); ?>
						
						<div class="line_flex">
							<div class="line_form">
								<label><?=$model->getAttributeLabel('summ');?></label>
								<?= $form->field($model, 'summ')->textInput(['maxlength' => true, 'placeholder' => "Сумма", 'class' => 'input'])->label(false);?>
							</div>

							<div class="line_form">
								<label><?=$model->getAttributeLabel('term');?></label>

								<div class="selectWrap"> 
								 
									<?=$form->field($model, 'term')->dropDownList([
										''   => 'Выберите',
										'3' => '3',
										'6' => '6',
										'12' => '12',
										'24' => '24',
										'36' => '36',
										'48' => '48',
										'60' => '60'
									])->label(false);?> 
								</div>
							</div>
							
							<div class="line_form">
								<label><?=$model->getAttributeLabel('city');?></label>
								<?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => "Москва", 'class' => 'input'])->label(false);?>
							</div>

							<div class="line_form">
								<label><?=$model->getAttributeLabel('employment');?></label>
								<div class="selectWrap">
									<?=$form->field($model, 'employment')->dropDownList([
										''   => 'Выберите',
										'Работа по найму'   => 'Работа по найму',
										'Индивидуальный предприниматель'   => 'Индивидуальный предприниматель',
										'Пенсионер'   => 'Пенсионер',
										'Военный'   => 'Военный',
										'Не работаю'   => 'Не работаю',
									])->label(false);?> 
								</div>
							</div>

							<div class="line_form">
								
								<label><?=$model->getAttributeLabel('work_month');?></label>
								<div class="block_flex">
									<div class="selectWrap">
										<?=$form->field($model, 'work_month')->dropDownList([
											''   => 'Выберите',
											'01' => 'Январь',
											'02' => 'Февраль',
											'03' => 'Март',
											'04' => 'Апрель',
											'05' => 'Май',
											'06' => 'Июнь',
											'07' => 'Июль',
											'08' => 'Август',
											'09' => 'Сентябрь',
											'10' => 'Октябрь',
											'11' => 'Ноябрь',
											'12' => 'Декабрь',
										])->label(false);?> 
									</div>

									<div class="selectWrap">
										<?=$form->field($model, 'work_year')->dropDownList($arYears)->label(false);?> 
									</div>
								</div>
							</div>

							<div class="line_form">
								<label><?=$model->getAttributeLabel('income');?></label>
								<?= $form->field($model, 'income')->textInput(['maxlength' => true, 'placeholder' => "Сумма", 'class' => 'input'])->label(false);?>
							</div>

							<div class="line_form">
								<label><?=$model->getAttributeLabel('provision');?></label>
								<div class="selectWrap">
									<?=$form->field($model, 'provision')->dropDownList([
										''   => 'Выберите',
										'Без залога'   => 'Без залога',
										'Под залог недвижимости'   => 'Под залог недвижимости',
									])->label(false);?> 
								</div>
							</div>

							<div class="line_form">
							
								<div class="checkbox">
									<input type="checkbox" name="Orders[have_auto]" value="1" uncheckvalue="0" id="check1">

									<label for="check1">У меня есть автомобиль</label>
								</div>
							</div>
						</div>

						<div class="title">Контактные данные</div>

						<div class="line_flex">
							
							<div class="line_form">
								<label><?=$model->getAttributeLabel('last_name');?></label>
								<?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
							</div>
							
							<div class="line_form">
								<label><?=$model->getAttributeLabel('name');?></label>
								<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
							</div>
							
							<div class="line_form">
								<label><?=$model->getAttributeLabel('second_name');?></label>
								<?= $form->field($model, 'second_name')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
							</div>
							

							<div class="line_form">
								<label><?=$model->getAttributeLabel('phone');?></label>
								<?= $form->field($model, 'phone')->textInput(['type' => 'tel', 'placeholder' => "", 'class' => 'input'])->label(false);?>
							</div>
							
							<div class="line_form">
								<label><?=$model->getAttributeLabel('email');?></label>
								<?= $form->field($model, 'email')->textInput(['type' => 'email', 'placeholder' => "", 'class' => 'input'])->label(false);?>
							</div>
						</div>
						
						<div class="box_btn">
							<div class="submit">
								<?= Html::submitButton('Отправить заявку', ['class' => 'submit_btn order_submit', 'disabled' => 'disabled']) ?>
							</div>

							<div class="checkbox agree">
								<input type="checkbox" name="" id="agree1">

								<label for="agree1">Я даю свое согласие на обработку персональных даных</label>
							</div>
						</div>
						
						<?= $form->field($model, 'service_id')->textInput(['type' => 'hidden'])->label(false);?>

					<?php ActiveForm::end(); ?>
					
				<?endif;?>	
				
				<?php Pjax::end(); ?>
				</div>
			</div>
		</section>