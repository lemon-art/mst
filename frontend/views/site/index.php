<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
$this->title = 'MarketVibor - подбор кредита';
?>

	<section class="section_amenities">
		<div class="cont">
			<div class="main_title">Выберите свою услугу</div>
			
				<?
				echo ListView::widget([
				    'dataProvider' => $servicesProvider,
				    'itemView' => '_services',
				    'layout' => '{items}',
				    'id'           => false,
				    'options' => [
					    'tag'=>'div',
					    'class' => 'amenities owl-carousel'
				    ],
				    'itemOptions' => [
					'tag' => false,
				    ],
				    'viewParams' => [
					'fullView' => false,
					'context' => 'main-page',
				    ],
				]);
				?>
			
			</div>
		</div>
	</section>

<section class="sectionMarg">
			<div class="cont">
				<div class="main_title">Спецпредложения месяца</div>

					
					<?
					echo ListView::widget([
						'dataProvider' => $bestOffersProvider,
						'itemView' => '_best_offers',
						'layout' => '{items}',
						'id'           => false,
						'options' => [
							'tag'=>'div',
							'class' => 'best_month'
						],
						'itemOptions' => [
						'tag' => false,
						],
						'viewParams' => [
						'fullView' => false,
						'context' => 'main-page',
						],
					]);
					?>

				
				<div class="more_all">
					<a href="/specoffers">Смотреть все</a>
				</div>
			</div>
		</section>

		
		<?= $this->render('_request_form', [
			'model' => $reqModel,
		]) ?>

		


		<section class="sectionMarg">
			<div class="cont">
				<div class="main_title">Наши партнеры</div>
				
				
				<?
				echo ListView::widget([
				    'dataProvider' => $banksProvider,
				    'itemView' => '_banks',
				    'layout' => '{items}',
				    'id'           => false,
				    'options' => [
					    'tag'=>'div',
					    'class' => 'slider_partners owl-carousel'
				    ],
				    'itemOptions' => [
					'tag' => false,
				    ],
				    'viewParams' => [
					'fullView' => false,
					'context' => 'main-page',
				    ],
				]);
				?>
				
				
			</div>
		</section>


		<section class="section_reviews sectionMarg">
			<div class="cont">
				<div class="main_title white">Отзывы наших клиентов</div>
				
				<div class="slider_reviews owl-carousel">
					<div class="comment">
						<div class="user">
							<div class="foto">
								<img src="images/foto1.jpg" alt="">
							</div>

							<div class="name">Иван Иванов</div>
						</div>

						<div class="text">Пользовался сервисом когда оформлял искал на автомобиль. Все очень удобно и наглядно, сравнил варианты всех банков и выбрал наиболле выгодный для меня. <a href="/" class="more">Читать далее</a></div>
					</div>

					<div class="comment">
						<div class="user">
							<div class="foto">
								<img src="images/foto1.jpg" alt="">
							</div>

							<div class="name">Иван Иванов</div>
						</div>

						<div class="text">Пользовался сервисом когда оформлял искал на автомобиль. Все очень удобно и наглядно, сравнил варианты всех банков и выбрал наиболле выгодный для меня. <a href="/" class="more">Читать далее</a></div>
					</div>

					<div class="comment">
						<div class="user">
							<div class="foto">
								<img src="images/foto1.jpg" alt="">
							</div>

							<div class="name">Иван Иванов</div>
						</div>

						<div class="text">Пользовался сервисом когда оформлял искал на автомобиль. Все очень удобно и наглядно, сравнил варианты всех банков и выбрал наиболле выгодный для меня. <a href="/" class="more">Читать далее</a></div>
					</div>

					<div class="comment">
						<div class="user">
							<div class="foto">
								<img src="images/foto1.jpg" alt="">
							</div>

							<div class="name">Иван Иванов</div>
						</div>

						<div class="text">Пользовался сервисом когда оформлял искал на автомобиль. Все очень удобно и наглядно, сравнил варианты всех банков и выбрал наиболле выгодный для меня. <a href="/" class="more">Читать далее</a></div>
					</div>
				</div>
			</div>
		</section>

	<section class="sectionMarg">
		<div class="cont">
			<div class="main_title">Последние статьи</div>
				
				<?
				echo ListView::widget([
				    'dataProvider' => $articlesProvider,
				    'itemView' => '_articles',
				    'layout' => '{items}',
				    'id'           => false,
				    'itemOptions' => [
					'tag' => false,
				    ],
				    'options' => [
					    'tag'=>'div',
					    'class' => 'slider_articles owl-carousel'
				    ],
				    'viewParams' => [
					'fullView' => false,
					'context' => 'main-page',
					// ...
				    ],
				]);
				?>
		</div>
	</section>
	
	
