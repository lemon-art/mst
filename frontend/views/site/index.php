<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
$this->title = 'My Yii Application';
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

				<div class="best_month">
					<div class="item">
						<div class="img">
							<a href="/">
								<img src="images/img1.jpg" alt="">
							</a>
						</div>

						<div class="box">
							<div class="name">Ипотека 5%</div>

							<ul class="list">
								<li>известный банк;</li>
								<li>моментальное одобрение;</li>
								<li>срок до 20 лет.</li>
							</ul>

							<div class="more">
								<a href="/">Узнать подробнее</a>
							</div>
						</div>
					</div>

					<div class="item">
						<div class="img">
							<a href="/">
								<img src="images/img2.jpg" alt="">
							</a>
						</div>

						<div class="box">
							<div class="name">Автокредит 5%</div>

							<ul class="list">
								<li>известный банк;</li>
								<li>моментальное одобрение;</li>
								<li>срок до 20 лет.</li>
							</ul>

							<div class="more">
								<a href="/">Узнать подробнее</a>
							</div>
						</div>
					</div>
				</div>
				
				<div class="more_all">
					<a href="/">Смотреть все</a>
				</div>
			</div>
		</section>


		<section class="section_form sectionMarg">
			<div class="cont">
				<div class="title">Не хотите самостоятельно <span>подбирать продукт</span>?</div>

				<div class="subTitle">Оставьте свой телефон и мы с Вами свяжемся!</div>

				<div class="form">
					<form action="">
						<div class="line_flex">
							<div class="line_form">
								<label>Ваше имя</label>

								<input type="text" name="" value="" placeholder="Иван" class="input">
							</div>

							<div class="line_form">
								<label>Ваш телефон</label>

								<input type="tel" name="" value="" placeholder="+7 (___)-___-__-__" class="input">
							</div>
						</div>

						<div class="submit">
							<input type="submit" value="Отправить заявку" class="submit_btn">
						</div>
					</form>
				</div>
			</div>
		</section>


		<section class="sectionMarg">
			<div class="cont">
				<div class="main_title">Наши партнеры</div>
				
				<div class="slider_partners owl-carousel">
					<div class="slide">
						<img src="images/partner1.png" alt="">
					</div>

					<div class="slide">
						<img src="images/partner2.png" alt="">
					</div>

					<div class="slide">
						<img src="images/partner3.png" alt="">
					</div>

					<div class="slide">
						<img src="images/partner4.png" alt="">
					</div>

					<div class="slide">
						<img src="images/partner1.png" alt="">
					</div>

					<div class="slide">
						<img src="images/partner2.png" alt="">
					</div>

					<div class="slide">
						<img src="images/partner3.png" alt="">
					</div>

					<div class="slide">
						<img src="images/partner4.png" alt="">
					</div>
				</div>
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
	
	
