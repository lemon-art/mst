<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use frontend\components\OrderForm;
/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>


		<section class="sectionMarg">
			<div class="cont">
				<div class="main_title">Наши преимущества</div>

				<div class="advantages owl-carousel">
					<div class="slide">
						<div class="number">01</div>

						<div class="name">Сэкономьте свое время</div>

						<div class="text">Не нужно тратить время на просмотр огромного каталога кредитов.</div>
					</div>

					<div class="slide">
						<div class="number">02</div>

						<div class="name">Сэкономьте свое время</div>

						<div class="text">Не нужно тратить время на просмотр огромного каталога кредитов.</div>
					</div>

					<div class="slide">
						<div class="number">03</div>

						<div class="name">Сэкономьте свое время</div>

						<div class="text">Не нужно тратить время на просмотр огромного каталога кредитов.</div>
					</div>
				</div>
			</div>
		</section>


		<section class="scheme_work sectionMarg">
			<div class="cont">
				<div class="main_title">Схема работы</div>
				
				<div class="slider_scheme owl-carousel">
					<div class="slide">
						<div class="icon">
							<img src="/images/ic_shema1.svg" alt="">
						</div>

						<div class="text">Вы выбираете параметры кредита и заполняете анкету</div>
					</div>

					<div class="slide">
						<div class="icon">
							<img src="/images/ic_shema2.svg" alt="">
						</div>

						<div class="text">Мы автоматически регистрируем Вас в нашей системе и  подбираем Вам все предложения банков</div>
					</div>

					<div class="slide">
						<div class="icon">
							<img src="/images/ic_shema3.svg" alt="">
						</div>

						<div class="text">Вы в личном кабинете выбираете лучшее предложение</div>
					</div>
				</div>
			</div>
		</section>



		<section class="sectionMarg">
			<div class="cont">
				<div class="main_title">Выгодные предложения</div>
				
				<div class="table_profitably">
					<div class="item_head">
						<div class="box"><span>№</span> Банк</div>

						<div class="box">Ставка</div>

						<div class="box">Срок</div>

						<div class="box">Преимущества</div>
					</div>
					
					
						<?
						echo ListView::widget([
							'dataProvider' => $offersProvider,
							'itemView'     => function ($model, $key, $index, $widget) {
								return $this->render('_offers', ['model' => $model, 'index' => $index+1]);
							},
							'layout' => '{items}',
							'id'           => false,
							'itemOptions' => [
							'tag' => false,
							],
							'options' => [
								'tag'=>'div',
								'class' => 'mob_profitably owl-carousel'
							],
							'viewParams' => [
							'fullView' => false,
							'context' => 'main-page',
							// ...
							],
						]);
						?>
					
					
						

						
				</div>
			</div>
		</section>

		<?=OrderForm::widget(['service_id' => $model->id]);?>