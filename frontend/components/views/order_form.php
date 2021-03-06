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
						<?php $id_order = Orders::find()->select(['id', 'order_id'])->where(['order_id' => $model->id])->orderBy(['id' => SORT_DESC])->one();//id заявки берем из Orders ?>
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
							<?php
							///if ( isset($_COOKIE["actionpay"]) ){
							//	echo '<img src="http://apypp.com/ok/18610.png?actionpay='.$_COOKIE["actionpay"].'&apid='.$model->id.'" width="1px" height="1px"/>';
							//}
							?>						
<?
$js = <<< JS
jQuery(document).ready(function(){jQuery('html, body').animate({scrollTop: jQuery("#order_completed").offset().top - 50}, 1000);});
ym(52131253, 'reachGoal', 'credit');
gtag('event', 'credit');
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
						
						<h3 class="hidden">Основное</h3>
						<section class="step0 center_button">
						
							<div class="line_flex">
							
								<?if ( Yii::$app->user->isGuest):?>
								
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('name');?></label>
										<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input kirilica'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('phone');?></label>
										<?= $form->field($model, 'phone')->textInput(['type' => 'tel', 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>								

									
								<?else:?>

									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('name');?></label>
										<?= $form->field($model, 'name', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->name, 'placeholder' => "", 'class' => 'input kirilica'])->label(false);?>
									</div>
									

									<div class="line_form">
										<label><?=$model->getAttributeLabel('phone');?></label>
										<?= $form->field($model, 'phone', ['options' => ['class' => 'form-group has-success']])->textInput(['type' => 'tel', 'value' => $profileUser->phone, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
									
																
								
								<?endif;?>									
									
								

							</div>
							<div class="line_flex">
						
									<div class="line_form">
										<label><?=$model->getAttributeLabel('summ');?></label>
										<?= $form->field($model, 'summ')->textInput(['maxlength' => true, 'placeholder' => "Введите число", 'class' => 'input summa required '])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('term');?></label>

										<div class="selectWrap"> 
										 
											<?=$form->field($model, 'term')->dropDownList([
												''   => 'Выберите',
												'1' => '1 месяц',
												'3' => '3 месяца',
												'6' => '6 месяцев',
												'9' => '9 месяцев',
												'12' => '1 год',
												'24' => '2 года',
												'36' => '3 года',
												'48' => '4 года',
												'60' => '5 лет'
											], ['class' => 'required'])->label(false);?> 
										</div>
									</div>
									
								
							</div>
							<div class="line_flex">
								<div class="line_form_one">
										<?= $form->field($model, 'agree', [
											'template' => '{input}{label}{error}',
											'options' => ['class' => 'form-group checkbox agree has-success'],
											])->textInput(['type' => 'checkbox', 'checked' => 'checked', 'value' => '1', 'uncheckValue' => '0'])->label('Я даю свое согласие на обработку персональных данных');?>
									</div>
								<?= $form->field($model, 'secret_key')->textInput(['type' => 'hidden', 'value' => Yii::$app->getSecurity()->generateRandomString(20)])->label(false);?>
							</div>
						</section>
						
						<h3 class="hidden">Общие данные</h3>
						<section class="step1">
						
							<div class="line_flex">
							
								<?if ( Yii::$app->user->isGuest):?>
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('last_name');?></label>
										<?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input required kirilica'])->label(false);?>
									</div>
									
							
									<div class="line_form">
										<label><?=$model->getAttributeLabel('second_name');?></label>
										<?= $form->field($model, 'second_name')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input kirilica'])->label(false);?>
									</div>
									

									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('email');?></label>
										<?= $form->field($model, 'email')->textInput(['type' => 'email', 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								

									
								<?else:?>
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('last_name');?></label>
										<?= $form->field($model, 'last_name', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->last_name, 'placeholder' => "", 'class' => 'input required kirilica'])->label(false);?>
									</div>
									
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('second_name');?></label>
										<?= $form->field($model, 'second_name', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->second_name, 'placeholder' => "", 'class' => 'input kirilica'])->label(false);?>
									</div>
									

									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('email');?></label>
										<?= $form->field($model, 'email', ['options' => ['class' => 'form-group has-success']])->textInput(['type' => 'email', 'value' => $profileUser->email, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								
								
								<?endif;?>
							</div>
						
							<h4 class="title">Основные параметры</h4>
							<div class="line_flex">
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('city');?></label>
									<?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => "Москва", 'class' => 'input kirilica'])->label(false);?>
								</div>
								<div class="line_form">
									<label><?=$model->getAttributeLabel('purpose');?></label>
									<div class="selectWrap">
										<?=$form->field($model, 'purpose')->dropDownList([
											''   => 'Выберите',
											'Ремонт'   => 'Ремонт',
											'Погашение кредитов'   => 'Погашение кредитов',
											'Учеба'   => 'Учеба',
											'Развитие бизнеса'   => 'Развитие бизнеса',
											'Лечение'   => 'Лечение',
											'Погашение долгов (не кредиты)' => 'Погашение долгов (не кредиты)',
											'Шоппинг' => 'Шоппинг',
											'Путешествие' => 'Путешествие',
											'Торжество' => 'Торжество',
											'Помощь близким' => 'Помощь близким',
											'Иное' => 'Иное'
											
										])->label(false);?> 
									</div>
								</div>
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('income');?></label>
									<?= $form->field($model, 'income')->textInput(['maxlength' => true, 'placeholder' => "Введите число", 'class' => 'input summa'])->label(false);?>
								</div>
								
								
								
								
							</div>	
							
							
						</section>

						<h3 class="hidden">Паспортные данные</h3>

						<section class="step2">
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
										<?= $form->field($model, 'bithday', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->bithday,  'placeholder' => "", 'class' => 'input date'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('birthplace');?></label>
										<?= $form->field($model, 'birthplace', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->birthPlace, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('sn');?></label>
										<?= $form->field($model, 'sn', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->sn, 'placeholder' => "", 'class' => 'input sn'])->label(false);?>
									</div>
									
								</div>
								
								<div class="line_flex">
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('issuedate');?></label>
										<?= $form->field($model, 'issuedate', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->issueDate, 'placeholder' => "", 'class' => 'input date'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('issuecode');?></label>
										<?= $form->field($model, 'issuecode', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->issueCode, 'placeholder' => "", 'class' => 'input issueCode'])->label(false);?>
									</div>
								
									
								</div>
								
								<div class="line_flex">
									<div class="line_form_one">
										<label><?=$model->getAttributeLabel('issuer');?></label>
										<?= $form->field($model, 'issuer', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->issuer, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								</div>
								
								<div class="line_flex">
									<div class="line_form_one">
										<label><?=$model->getAttributeLabel('address');?></label>
										<?= $form->field($model, 'address', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->address, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
								</div>
								
								<div class="line_flex">
									<div class="line_form">
										<label><?=$model->getAttributeLabel('registrationdate');?></label>
										<?= $form->field($model, 'registrationdate', ['options' => ['class' => 'form-group has-success']])->textInput(['maxlength' => true, 'value' => $profileUser->registrationDate, 'placeholder' => "", 'class' => 'input date'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('registrationphone');?></label>
										<?= $form->field($model, 'registrationphone', ['options' => ['class' => 'form-group has-success']])->textInput(['type' => 'tel', 'value' => $profileUser->registrationPhone, 'maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
									
								</div>
							
							
							<?endif;?>
							
						</section>
						
						<h3 class="hidden">Данные о работе</h3>

						<section class="step3">	
							<h4 class="title">Данные о работе</h4>
							
							<div class="line_flex">
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
									<label><?=$model->getAttributeLabel('organizationname');?></label>
									<?= $form->field($model, 'organizationname')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
								</div>
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('areaofemployment');?></label>
									<div class="selectWrap">
										<?=$form->field($model, 'areaofemployment')->dropDownList([
											''   => 'Выберите',
											'Горнодобывающая промышленность'  => 'Горнодобывающая промышленность',
											'Государственное, муниципальное управление'  => 'Государственное, муниципальное управление',
											'Здравоохранение, социальные услуги'  => 'Здравоохранение, социальные услуги',
											'Культура, искусство, спортивная деятельность'  => 'Культура, искусство, спортивная деятельность',
											'Оборона, правоохранительные органы'  => 'Оборона, правоохранительные органы',
											'Обрабатывающая промышленность (производство)'  => 'Обрабатывающая промышленность (производство)',
											'Профессиональная, научная, техническая деятельность'  => 'Профессиональная, научная, техническая деятельность',
											'Сельское хозяйство, рыболовство, охота, лесоводство'  => 'Сельское хозяйство, рыболовство, охота, лесоводство',
											'Сфера торговли, услуг, связи'  => 'Сфера торговли, услуг, связи',
											'Транспорт'  => 'Транспорт',
											'Финансовая деятельность, страхование'  => 'Финансовая деятельность, страхование',
											'Иное'  => 'Иное'
										])->label(false);?> 
									</div>
								</div>
							</div>	
							<div class="line_flex">
								<div class="line_form">
									
									<label><?=$model->getAttributeLabel('work_month');?></label>
									<div class="block_flex">
										<div class="selectWrap">
											<?=$form->field($model, 'work_month')->dropDownList([
												''   => 'Месяц',
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
									<label><?=$model->getAttributeLabel('jobtitle');?></label>
									<?= $form->field($model, 'jobtitle')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
								</div>

								<div class="line_form">
									<label><?=$model->getAttributeLabel('jobtype');?></label>
									<div class="selectWrap">
										<?=$form->field($model, 'jobtype')->dropDownList([
											''   => 'Выберите',
											'Руководитель организации'   => 'Руководитель организации',
											'Руководитель подразделения'   => 'Руководитель подразделения',
											'Неруководящий сотрудник - специалист'   => 'Неруководящий сотрудник - специалист',
											'Неруководящий сотрудник - обсл. персонал'   => 'Неруководящий сотрудник - обсл. персонал',
										])->label(false);?> 
									</div>
								</div>
							</div>
							<div class="line_flex">
							
								<div class="line_form">
									<label><?=$model->getAttributeLabel('workaddress');?></label>
									<?= $form->field($model, 'workaddress')->textInput(['maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
								</div>
								
								<div class="line_form">
									<label><?=$model->getAttributeLabel('workphone');?></label>
									<?= $form->field($model, 'workphone')->textInput(['type' => 'tel', 'maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
								</div>
							
							
							</div>


							
						</section>
						
						
						<h3 class="hidden">Доп.Информация</h3>
						<section class="step4">	
							<h4 class="title">Доп.Информация</h4>	
							

								<div class="line_flex">
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('phone_dop');?></label>
										<?= $form->field($model, 'phone_dop')->textInput(['type' => 'tel', 'maxlength' => true, 'placeholder' => "", 'class' => 'input'])->label(false);?>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('phone_dop_own');?></label>
										<div class="selectWrap">
											<?=$form->field($model, 'phone_dop_own')->dropDownList([
												''   => 'Выберите',
												'Мой номер'   => 'Мой номер',
												'Номер родственника'   => 'Номер родственника',
												'Номер друга'   => 'Номер друга',
											])->label(false);?> 
										</div>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('education');?></label>
										<div class="selectWrap">
											<?=$form->field($model, 'education')->dropDownList([
												''   => 'Выберите',
												'Начальное, среднее'   => 'Начальное, среднее',
												'Неполное высшее'   => 'Неполное высшее',
												'Высшее'   => 'Высшее',
												'Второе высшее'   => 'Второе высшее',
												'Ученая степень'   => 'Ученая степень',
											])->label(false);?> 
										</div>
									</div>
								</div>	
									
								<div class="line_flex">
									
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('family');?></label>
										<div class="selectWrap">
											<?=$form->field($model, 'family')->dropDownList([
												''   => 'Выберите',
												'Холост/не замужем'   => 'Холост/не замужем',
												'Разведен(а)'   => 'Разведен(а)',
												'Гражданский брак'   => 'Гражданский брак',
												'Женат/замужем'   => 'Женат/замужем',
												'Вдовец/вдова'   => 'Вдовец/вдова',
											])->label(false);?> 
										</div>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('child');?></label>
										<div class="selectWrap">
											<?=$form->field($model, 'child')->dropDownList([
												''   => 'Выберите',
												'No'   => 'Нет',
												'1'   => '1',
												'2'   => '2',
												'3'   => '3',
												'Больше 3'   => 'Больше 3',
											])->label(false);?> 
										</div>
									</div>
								</div>	
								
								
								
								<div class="line_flex">	
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('additional_income');?></label>
										<?= $form->field($model, 'additional_income')->textInput(['maxlength' => true, 'placeholder' => "Введите число", 'class' => 'input summa'])->label(false);?>
									</div>
									
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('have_auto');?></label>
										<div class="selectWrap">
											<?=$form->field($model, 'have_auto')->dropDownList([
												''   => 'Выберите',
												'Нет'   => 'Нет',
												'Отечественный'   => 'Отечественный',
												'Иномарка'   => 'Иномарка',
											])->label(false);?> 
										</div>
									</div>
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('rent_apartment');?></label>
										<?= $form->field($model, 'rent_apartment')->textInput(['maxlength' => true, 'placeholder' => "Введите число", 'class' => 'input summa'])->label(false);?>
									</div>
									
								</div>
								
								<div class="line_flex">	
								
									<div class="line_form">
										<label><?=$model->getAttributeLabel('credit_history');?></label>
										<div class="selectWrap">
											<?=$form->field($model, 'credit_history')->dropDownList([
												''   => 'Выберите',
												'Всегда плачу вовремя'   => 'Всегда плачу вовремя',
												'Бывают просрочки'   => 'Бывают просрочки',
												'Было много просрочек'   => 'Было много просрочек',
												'Есть текущие просрочки'   => 'Есть текущие просрочки',
												'Не было кредитов'   => 'Не было кредитов',
												'Не знаю'   => 'Не знаю',
											])->label(false);?> 
										</div>
									</div>
									
									<div class="line_form">
										<label><?=$model->getAttributeLabel('snils');?></label>
										<?= $form->field($model, 'snils')->textInput(['maxlength' => true, 'placeholder' => "Введите число", 'class' => 'input summa'])->label(false);?>
									</div>
								</div>

						
								<?= $form->field($model, 'service_id')->textInput(['type' => 'hidden', 'class' => 'service_id'])->label(false);?>
							</section>
					
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
		onInit: function (event, currentIndex) { 
			$('.actions').addClass('center_button');
		},
		onStepChanging: function (event, currentIndex, newIndex) { 


			cur = currentIndex;
			errorFound = false;
			ret = true;
			tmp = [];
			
			
			if ( newIndex == 0 ){
				$('.actions').removeClass('center_button');
			}
			
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
							validateField ( el );

							if ( $(this).hasClass('has-success') ){ 
							 
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
				
					if ( currentIndex == 0 ){
					
						$.fancybox.close()
						$.fancybox.open({
							src  : '#modal_help',
							type : 'inline',
							opts : {
								speed: 300,
								autoFocus : false,
								i18n : {
									'en' : {
										CLOSE : 'Закрыть'
									}
								},
								touch : false
							}
						})
						
							$('body').on( 'click', '.close_popup', function(e){
								
								$.fancybox.close();
								return false;
							});
							
							$('body').on( 'click', '.need_help_modal', function(e){
								
								
								var secret_key = $('#kredit-secret_key').val();
								
								$.ajax({
									url: '/orders/activatelostorder/'+secret_key+'/',
									type: 'post',
									success: function (data) {
									
									}
								});
								
								$.fancybox.close();
								$('.actions').hide();
								$('.main__under_title').hide();
								$('#order-form').html('<div class="alert"><p>Наши менеджеры свяжутся с вами в ближашее время и помогут вам с заполнением заявки.</p></div>');
								$('html, body').animate({ scrollTop: $('#order-form').offset().top - 80 }, 500);
								return false;
							});
						
						
					}
					
					$('.actions').removeClass('center_button');
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

							
							if ( validateField ( el ) ){
							
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
					$('#requestOrderFormPjax').html('<div class="alert"><p>Ваша заявка принята. Вы можете следить за своими заявками в <a href="/personal">личном кабинете</a></p></div>');
					$('html, body').animate({ scrollTop: $('#requestOrderFormPjax').offset().top - 80 }, 500);
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
	$( "#kredit-name" ).change(function( ) {
		if ( $('#kredit-name').parent().hasClass('has-success') && $('#kredit-phone').parent().hasClass('has-success') ){
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
					if ( field == 'kredit-phone' ){

						if ( $('#kredit-name').parent().hasClass('has-success') && $('#kredit-phone').parent().hasClass('has-success') ){
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
		var secret_key = $('#kredit-secret_key').val();
		var name = $('#kredit-name').val();
		var phone = $('#kredit-phone').val();
		
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


