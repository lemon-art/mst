<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use backend\models\Orders;

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
						<?php $id_order = Orders::find()->select(['id', 'order_id'])->where(['order_id' => $model->id])->one();//id заявки берем из Orders ?>
<div class="alert" id="order_completed">
							Ваша заявка принята.<br>
							Вы можете следить за своими заявками в <a href="/personal">личном кабинете</a>.
<script type"text/javascript">
ADMITAD = window.ADMITAD || {};
ADMITAD.Invoice = ADMITAD.Invoice || {};
ADMITAD.Invoice.broker = 'adm';    // параметр дедупликации (по умолчанию для Admitad)
ADMITAD.Invoice.category = '1';    // код целевого действия (определяется при интеграции)

var orderedItem = [];              // временный массив 
	
orderedItem.push({
	Product: {
		category: '1',        // код тарифа (определяется при интеграции)
		price: 'no',   // сумма заказа(передавать при процентном вознаграждении)
		priceCurrency: 'RUB', // код валюты ISO-4217 alfa-3 >(передавать при процентном вознаграждении)
	},
	orderQuantity: '1',       // всегда 1
	additionalType: 'lead'     // всегда sale
});
ADMITAD.Invoice.referencesOrder = ADMITAD.Invoice.referencesOrder || [];
ADMITAD.Invoice.referencesOrder.push({
	orderNumber: '<?php echo $id_order->id; ?>', // внутренний номер заказа (не более 100 символов)
	orderedItem: orderedItem
});
// Важно! Если данные по заказу Admitad подгружаются через AJAX, раскомментируйте следующую строку.
ADMITAD.Tracking.processPositions();
</script>
<script type="text/javascript">
   ADMITAD = window.ADMITAD || {};
   ADMITAD.Invoice = ADMITAD.Invoice || {};
   ADMITAD.Invoice.accountId = '<?php echo $model->email; ?>'; // e-mail или логин пользователя в системе 
</script>
<?
$js = <<< JS
jQuery(document).ready(function(){jQuery('html, body').animate({scrollTop: jQuery("#order_completed").offset().top - 50}, 1000);});
ym(52131253, 'reachGoal', 'credit_card');
gtag('event', 'credit_card');
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
						
						<h3 class="hidden">Контактные данные</h3>
						<section class="step0">
						
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
											'options' => ['class' => 'checkbox agree form-group has-success']
											])->textInput(['type' => 'checkbox', 'checked' => 'checked',  'value' => '1', 'uncheckValue' => '0'])->label('Я даю свое согласие на обработку персональных данных');?>
									</div>
									
								<?else:?>
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('last_name');?></label>
										<?= $form->field($model, 'last_name', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->last_name, 'placeholder' => "", 'class' => 'input required kirilica'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('name');?></label>
										<?= $form->field($model, 'name', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true,  'value' => $profileUser->name, 'placeholder' => "", 'class' => 'input kirilica'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('second_name');?></label>
										<?= $form->field($model, 'second_name', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->second_name, 'placeholder' => "", 'class' => 'input kirilica'])->label(false);?>
									</div>
									

									<div class="line_form">
										<label><?=$model->getAttributeLabel('phone');?></label>
										<?= $form->field($model, 'phone', ['options' => ['class' => 'form-group has-success']])->textInput(['type' => 'tel', 'value' => $profileUser->phone, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('email');?></label>
										<?= $form->field($model, 'email', ['options' => ['class' => 'form-group has-success']])->textInput(['type' => 'email', 'value' => $profileUser->email, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								
									<div class="line_form_one">
										<?= $form->field($model, 'agree', [
											'template' => '{input}{label}{error}',
											'options' => ['class' => 'checkbox agree form-group has-success']
											])->textInput(['type' => 'checkbox', 'checked' => 'checked',  'value' => '1', 'uncheckValue' => '0'])->label('Я даю свое согласие на обработку персональных данных');?>
									</div>
								
								<?endif;?>
							</div>
						</section>
						
						<h3 class="hidden">Общие данные</h3>
						<section class="step1">
						
							<h4 class="title">Основные параметры</h4>
							<div class="line_flex">
						
								<div class="line_form">
									<label><?=$model->getAttributeLabel('summ');?></label>
									<?= $form->field($model, 'summ')->textInput(['maxlength' => true, 'placeholder' => "Введите число", 'class' => 'input summa required '])->label(false);?>
								</div>
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('income');?></label>
									<?= $form->field($model, 'income')->textInput(['maxlength' => true, 'placeholder' => "Введите число", 'class' => 'input summa required '])->label(false);?>
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
								
								<?= $form->field($model, 'secret_key')->textInput(['type' => 'hidden', 'value' => Yii::$app->getSecurity()->generateRandomString(20)])->label(false);?>
	
							</div>	

							
							
						</section>
						
					</div>
					
					<?= $form->field($model, 'service_id')->textInput(['type' => 'hidden', 'class' => 'service_id'])->label(false);?>

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
					$(document).ready(function(){jQuery('html, body').animate({scrollTop: jQuery("#completed").offset().top}, 1000);});
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
					$('.actions').hide();
					$('#order-form').yiiActiveForm('submitForm');
					$('.main__under_title').hide();
					$('#requestOrderFormPjax').html('<p>Ваша заявка принята. Мы свяжемся с вами в ближайшее время.</p>');
					$('html, body').animate({ scrollTop: $('#requestOrderFormPjax').offset().top - 60 }, 500);
				}

		},

	});
	
	$('body').on( 'change', '.form-group.required select', function(e){
		
		var el = $(this);
		validateField ( el );
	
	});
	
	$( ".steps .form-group.required input" ).keyup(function( ) {
		
		var el = $(this);
		validateField ( el );
	
	});
	
	$( ".steps .form-group.required input" ).change(function( ) {
		
		var el = $(this);
		validateField ( el );
	
	});
	
	//проверяем и сохраняем короткую заявку
	$( "#kreditkards-name" ).change(function( ) {
		if ( $('#kreditkards-name').parent().hasClass('has-success') && $('#kreditkards-phone').parent().hasClass('has-success') ){
			SaveLastOrder( );
		}
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
		    url: '/orders/validate/',
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
					
					//проверяем и сохраняем короткую заявку
					if ( field == 'kreditkards-phone' ){

						if ( $('#kreditkards-name').parent().hasClass('has-success') && $('#kreditkards-phone').parent().hasClass('has-success') ){
							SaveLastOrder( );
						}
						
					}
					
					
					return true;
				}
				
		   }
		});
	
	
	}

	function SaveLastOrder( ){
	
		var service_id = $('.service_id').val();
		var secret_key = $('#kreditkards-secret_key').val();
		var name = $('#kreditkards-name').val();
		var phone = $('#kreditkards-phone').val();
		
		$.ajax({
		    url: '/orders/savelostorder/',
		    type: 'post',
		    data: {'name': name, 'phone': phone, 'service_id': service_id, 'secret_key': secret_key},
		    success: function (data) {
			
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


