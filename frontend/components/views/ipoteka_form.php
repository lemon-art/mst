<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
$arYears = Array(''   => 'Год');
$year = date('Y');
for ( $i = 0; $i < 15; $i++){
	$arYears[$year - $i] = $year - $i;
}


?>	



		<section class="section_request sectionMarg" id="completed">
			<div class="cont">
				<div class="main_title">Заполните заявку</div>
				
				<?if ( Yii::$app->user->isGuest):?>
					<p class="main__under_title">Если вы ранее уже заполняли заявку, <a href="#modal_login" class="modal_link">войдите на сайт</a>, чтобы не заполнять ее заново.</p>
				<?endif;?>
				
				<div class="need_help right">
					<a href="#modal_call" class="modal_link">Мне нужна помощь</a>
				</div>
				<div class="clear"></div>

				<div class="form">
					<?
					
					//Pjax::begin([
					//	'id' => 'requestOrderFormPjax',
					//	'timeout' => false,
					//	'enablePushState' => true,
					//	'enableReplaceState' => true,
					//]); 
					
					?>
				
					<?php if (Yii::$app->session->hasFlash('requestOrderFormSubmitted')): ?>
						<div class="alert" id="order_completed">
							Ваша заявка принята.<br>
							Вы можете следить за своими заявками в <a href="/personal">личном кабинете</a>.
							
<?
$js = <<< JS
jQuery(document).ready(function(){jQuery('html, body').animate({scrollTop: jQuery("#order_completed").offset().top - 50}, 1000);});
JS;
$this->registerJs($js);
?>	
							
							
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
					
					<div class="steps">					
						<h3 class="hidden">Общие данные</h3>
						<section class="step0">
						
							<h4 class="title">Основные параметры</h4>
							<div class="line_flex">
						
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('purpose');?></label>

									<div class="selectWrap"> 
									 
										<?=$form->field($model, 'purpose')->dropDownList([
											''   => 'Выберите',
											'Покупка квартиры' => 'Покупка квартиры',
											'Покупка апартаментов' => 'Покупка апартаментов',
											'Покупка загородного дома/таунхауса' => 'Покупка загородного дома/таунхауса',
											'Рефинансирование' => 'Рефинансирование'
										], ['class' => 'required'])->label(false);?> 
									</div>
								</div>
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('type');?></label>

									<div class="selectWrap"> 
									 
										<?=$form->field($model, 'type')->dropDownList([
											''   => 'Выберите',
											'Вторичное жилье' => 'Вторичное жилье',
											'Новостройка' => 'Новостройка',
										], ['class' => 'required'])->label(false);?> 
									</div>
								</div>
								
								
							</div>	
							
							<div class="line_flex">
						
								<div class="line_form">
									<label><?=$model->getAttributeLabel('summ');?></label>
									<?= $form->field($model, 'summ')->textInput(['maxlength' => true, 'placeholder' => "Введите число", 'class' => 'input summa required '])->label(false);?>
								</div>
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('initial_payment');?></label>
									<?= $form->field($model, 'initial_payment')->textInput(['maxlength' => true, 'placeholder' => "Введите число", 'class' => 'input summa required '])->label(false);?>
								</div>
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('term');?></label>

									<div class="selectWrap"> 
										<?=$form->field($model, 'term')->dropDownList([
													''   => 'Выберите',
													'1' => '1 год',
													'2' => '2 года',
													'3' => '3 года',
													'5' => '5 лет',
													'10' => '10 лет',
													'15' => '15 лет',
													'20' => '20 лет',
													'25' => '25 лет',
													'30' => '30 лет',
													
										], ['class' => 'required'])->label(false);?> 
									</div>
								</div>	
							</div>
							
							<div class="line_flex">
								<div class="line_form">
									<label><?=$model->getAttributeLabel('city');?></label>
									<?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => "Москва", 'class' => 'input kirilica'])->label(false);?>
								</div>
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('summ_income');?></label>
									<?= $form->field($model, 'summ_income')->textInput(['maxlength' => true, 'placeholder' => "Введите число", 'class' => 'input summa'])->label(false);?>
								</div>
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('confirmation_income');?></label>

									<div class="selectWrap"> 
										<?=$form->field($model, 'confirmation_income')->dropDownList([
													''   => 'Выберите',
													'Найм, Справка 2-НДФЛ' => 'Найм, Справка 2-НДФЛ',
													'Найм, Справка по форме банка' => 'Найм, Справка по форме банка',
													'Найм, Устное подтверждение' => 'Найм, Устное подтверждение',
													'Созаемщик без учета дохода' => 'Созаемщик без учета дохода',
													'ИП, Налоговая декларация' => 'ИП, Налоговая декларация',
													'ИП, Иными документами' => 'ИП, Иными документами',
													'ИП, Устное подтверждение' => 'ИП, Устное подтверждение',
													'Собственник бизнеса, Налоговая декларация' => 'Собственник бизнеса, Налоговая декларация',
													'Собственник бизнеса, Иными документами' => 'Собственник бизнеса, Иными документами',
													'Собственник бизнеса, Устное подтверждение' => 'Собственник бизнеса, Устное подтверждение',
										], ['class' => 'required'])->label(false);?> 
									</div>
								</div>	
							
							</div>
							
							<h4 class="title">Контактные данные</h4>
							<div class="line_flex">
							
								<?if ( Yii::$app->user->isGuest):?>
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('last_name');?></label>
										<?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input required kirilica'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('name');?></label>
										<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input kirilica'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('second_name');?></label>
										<?= $form->field($model, 'second_name')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input kirilica'])->label(false);?>
									</div>
									

									<div class="line_form">
										<label><?=$model->getAttributeLabel('phone');?></label>
										<?= $form->field($model, 'phone')->textInput(['type' => 'tel', 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('email');?></label>
										<?= $form->field($model, 'email')->textInput(['type' => 'email', 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								
									<div class="line_form_one">
										<?= $form->field($model, 'agree', [
											'template' => '{input}{label}{error}',
											])->textInput(['type' => 'checkbox', 'value' => '1', 'uncheckValue' => '0'])->label('Я даю свое согласие на обработку персональных данных');?>
									</div>
									
								<?else:?>
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('last_name');?></label>
										<?= $form->field($model, 'last_name', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $profileUser->last_name, 'placeholder' => "", 'class' => 'input required kirilica'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('name');?></label>
										<?= $form->field($model, 'name', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true,  'value' => $profileUser->name, 'placeholder' => "", 'class' => 'input kirilica'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('second_name');?></label>
										<?= $form->field($model, 'second_name', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $profileUser->second_name, 'placeholder' => "", 'class' => 'input kirilica'])->label(false);?>
									</div>
									

									<div class="line_form">
										<label><?=$model->getAttributeLabel('phone');?></label>
										<?= $form->field($model, 'phone', ['options' => ['class' => 'form-group has-success']])->textInput(['type' => 'tel', 'readonly'=> true, 'value' => $profileUser->phone, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('email');?></label>
										<?= $form->field($model, 'email', ['options' => ['class' => 'form-group has-success']])->textInput(['type' => 'email', 'readonly'=> true, 'value' => $profileUser->email, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								
									<div class="line_form_one">
										<?= $form->field($model, 'agree', [
											'template' => '{input}{label}{error}',
											'options' => ['class' => 'form-group has-success']
											])->textInput(['type' => 'checkbox', 'value' => '1', 'checked' => 'checked', 'uncheckValue' => '0'])->label('Я даю свое согласие на обработку персональных данных');?>
									</div>
								
								<?endif;?>
							</div>
							
						</section>

						<h3 class="hidden">Паспортные данные</h3>

						<section class="step1">
							<h4 class="title">Паспортные данные</h4>
							
							<?if ( Yii::$app->user->isGuest || !$profileUser->sn ):?>
							
								<div class="line_flex">
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('bithday');?></label>
										<?= $form->field($model, 'bithday')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input date'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('birthplace');?></label>
										<?= $form->field($model, 'birthplace')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('sn');?></label>
										<?= $form->field($model, 'sn')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input sn'])->label(false);?>
									</div>
									
								</div>
								
								<div class="line_flex">
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('issuedate');?></label>
										<?= $form->field($model, 'issuedate')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input date'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('issuecode');?></label>
										<?= $form->field($model, 'issuecode')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input issueCode'])->label(false);?>
									</div>
								
									
								</div>
								
								<div class="line_flex">
									<div class="line_form_one">
										<label><?=$model->getAttributeLabel('issuer');?></label>
										<?= $form->field($model, 'issuer')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								</div>
								
								<div class="line_flex">
									<div class="line_form_one">
										<label><?=$model->getAttributeLabel('address');?></label>
										<?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								</div>
								
								<div class="line_flex">
									<div class="line_form">
										<label><?=$model->getAttributeLabel('registrationdate');?></label>
										<?= $form->field($model, 'registrationdate')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input date'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('registrationphone');?></label>
										<?= $form->field($model, 'registrationphone')->textInput(['type' => 'tel', 'maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
									
								</div>
							
							<?else:?>
							
								<div class="line_flex">
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('bithday');?></label>
										<?= $form->field($model, 'bithday', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $profileUser->bithday,  'placeholder' => "", 'class' => 'input date'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('birthplace');?></label>
										<?= $form->field($model, 'birthplace', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $profileUser->birthPlace, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('sn');?></label>
										<?= $form->field($model, 'sn', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $profileUser->sn, 'placeholder' => "", 'class' => 'input sn'])->label(false);?>
									</div>
									
								</div>
								
								<div class="line_flex">
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('issuedate');?></label>
										<?= $form->field($model, 'issuedate', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $profileUser->issueDate, 'placeholder' => "", 'class' => 'input date'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('issuecode');?></label>
										<?= $form->field($model, 'issuecode', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $profileUser->issueCode, 'placeholder' => "", 'class' => 'input issueCode'])->label(false);?>
									</div>
								
									
								</div>
								
								<div class="line_flex">
									<div class="line_form_one">
										<label><?=$model->getAttributeLabel('issuer');?></label>
										<?= $form->field($model, 'issuer', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $profileUser->issuer, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								</div>
								
								<div class="line_flex">
									<div class="line_form_one">
										<label><?=$model->getAttributeLabel('address');?></label>
										<?= $form->field($model, 'address', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $profileUser->address, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								</div>
								
								<div class="line_flex">
									<div class="line_form">
										<label><?=$model->getAttributeLabel('registrationdate');?></label>
										<?= $form->field($model, 'registrationdate', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $profileUser->registrationDate, 'placeholder' => "", 'class' => 'input date'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('registrationphone');?></label>
										<?= $form->field($model, 'registrationphone', ['options' => ['class' => 'form-group has-success']])->textInput(['type' => 'tel', 'readonly'=> true, 'value' => $profileUser->registrationPhone, 'maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
									
								</div>
							
							
							<?endif;?>
							
						</section>
						
						
						
						
						

								

						
						<?= $form->field($model, 'service_id')->textInput(['type' => 'hidden', 'class' => 'service_id'])->label(false);?>

					
					</div>
					<?php ActiveForm::end(); ?>
					
				<?endif;?>	
				
				<?//php Pjax::end(); ?>
				</div>
			</div>
		</section>
		
	<?php


//$urlCancel = Url::to(['account/index']);


$js = <<< JS


$(document).ready(function(){


	$('.steps').steps({

		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "fade",
		titleTemplate: '#title#',
		enableFinishButton: true,
		enableCancelButton: false,
		enablePreviousButton: false,
		labels: {

			next: "Дальше",
			finish: "Отправить",
			previous: "Назад",

		},
		onStepChanging: function (event, currentIndex, newIndex) { 

			cur = currentIndex;
			errorFound = false;
			ret = true;
			tmp = [];
			
			if ( newIndex > currentIndex ){

						
				$('.step' + cur).find('.form-group.required').each( 

					function(index) { 
						var isSelect = false;
						var idnya = $(this).find('input').attr('id');
						var el = $(this).find('input');
						if ( !idnya ){
							var idnya = $(this).find('select').attr('id');
							var el = $(this).find('select');
							isSelect = true;
						}
						
						if ( $(this).find('input').attr('type') == 'checkbox' ){
							isSelect = true;
						}

						if ( $(this).hasClass('has-success') ){
						
						}
						else {
							//$("#order-form").yiiActiveForm('validateAttribute', idnya);
							if ( validateField ( el )){
							
							}
							else {
								tmp.push('error');
								if ( !errorFound ){
									if ( isSelect )
										$('#'+idnya).css({display: 'block'});
										
									var top = $('#'+idnya).offset().top;
									
									if ( isSelect )
										$('#'+idnya).css({display: 'none'});
										

									$('html, body').animate({ scrollTop: top - 60 }, 500);
									errorFound = true;
								}
							}
						}

					}
				);
				
				
				if (tmp.length > 0) {
				
					ret = false; 

				} else {
					ret = true;
					$('.wizard>.steps').show();
				}

				tmp = [];
				

				return ret;
				//return true;
			}
			else {
				return true;
			}

		},  

		onCanceled: function (event) {

		},

		onFinished: function (event, currentIndex) {
		
				tmp = [];
				$('.step' + currentIndex).find('.form-group.required').each( 

					function(index) { 
						var isSelect = false;
						var idnya = $(this).find('input').attr('id');
						var el = $(this).find('input');
						if ( !idnya ){
							var idnya = $(this).find('select').attr('id');
							var el = $(this).find('select');
							isSelect = true;
						}
						
						if ( $(this).find('input').attr('type') == 'checkbox' ){
							isSelect = true;
						}

						if ( $(this).hasClass('has-success') ){
						
						}
						else {
							//$("#order-form").yiiActiveForm('validateAttribute', idnya);
							if ( validateField ( el )){
							
							}
							else {
								tmp.push('error');
								if ( !errorFound ){
									if ( isSelect )
										$('#'+idnya).css({display: 'block'});
										
									var top = $('#'+idnya).offset().top;
									
									if ( isSelect )
										$('#'+idnya).css({display: 'none'});
										

									$('html, body').animate({ scrollTop: top - 60 }, 500);
									errorFound = true;
								}
							}
						}

					}
				);
				if (tmp.length == 0) {
					$('#order-form').yiiActiveForm('submitForm');
					$('.main__under_title').hide();
					$('#requestOrderFormPjax').html('<div class="alert"><p>Ваша заявка принята. Вы можете следить за своими заявками в <a href="/personal">личном кабинете</a></p></div>');
					$('html, body').animate({ scrollTop: $('#requestOrderFormPjax').offset().top - 80 }, 500);
				}

		},

	});
	
	function validateField ( el ){
	
		var field = el.attr('id');
		var value = el.val();
		var service_id = $('.service_id').val();
		
		
		if ( el.attr('type') == 'checkbox' ){
			if ( !el.prop("checked") ){
				value = '';
			}
		}
		
		$.ajax({
		    url: '/orders/validate',
		    type: 'post',
		    data: {'field': field, 'value': value, 'service_id': service_id},
		    success: function (data) {
				error = null;
				var result = JSON.parse(data);
				for(k in result) {
					error = result[k];
				}
				if ( error ){
					el.parent().addClass('has-error').removeClass('has-success');
					el.parent().find('.help-block').html(error); 
					return false;
				}
				else {
					el.parent().removeClass('has-error').addClass('has-success');
					el.parent().find('.help-block').html('');
					return true;
				}
				
		   }
		});
	
	
	}


	/* Reinitialize */
	//маска телефона
	$('input[type=tel]').mask('+7 (999)-999-99-99')
	//маска даты
	$('input.date').mask('99.99.9999');
	//маска паспорта
	$('input.sn').mask('99 99 999999');
	
	//маска паспорта
	$('input.issueCode').mask('999 999');
});


JS;


$this->registerJs($js);




?>


