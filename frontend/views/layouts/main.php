<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<meta name="SKYPE_TOOLBAR" content ="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="site_wrap">

		<header>
			<div class="top_line">
				<div class="cont">
					<div class="logo">
						<a href="/">
							<img src="/images/logo.svg" alt="">
						</a>
					</div>

					<div class="block_search">
						<form>
							<input type="text" name="" value placeholder="Найдется все" class="search left">

							<input type="submit" value="" class="search_btn left">
							<div class="clear"></div>
						</form>
					</div>

					<div class="contact">
						<div class="tel">
							<a href="tel:+74952152904">+7 (495) 215-29-04</a>
						</div>

						<div class="call">
							<a href="#modal_call" class="modal_link">Перезвоните мне!</a>
						</div>
					</div>
					
					<div class="login">
						<a href="#modal_login" class="modal_link">
							<span>Вход</span>
						</a>
					</div>

					<a href="#" class="mob_menu_link">
						<span></span>
						<span></span>
						<span></span>
					</a>
				</div>
			</div>

			<div class="line_menu">
				<div class="cont">
					<div class="block_search">
						<form>
							<input type="text" name="" value placeholder="Найдется все" class="search left">

							<input type="submit" value="" class="search_btn left">
							<div class="clear"></div>
						</form>
					</div>

					
					
					<nav class="menu">
						<a href="/services/credit">
							<span>Кредиты</span>
						</a>
						<a href="/services/ipoteka">
							<span>Ипотека</span>
						</a>
						<a href="/services/deposit">
							<span>Депозиты</span>
						</a>
						<a href="/services/credit-cards">
							<span>Кредитные карты</span>
						</a>
						<a href="/services/debet-cards">
							<span>Дебетовые карты</span>
						</a>
						<a href="/services/credit-auto">
							<span>Автокредиты</span>
						</a>
						<a href="/services/specoffers">
							<span>Спецпредложения</span>
						</a>
						<a href="/services/rko">
							<span>РКО</span>
						</a>
					</nav>

					<div class="contact">
						<div class="tel">
							<a href="tel:+74952152904">+7 (495) 215-29-04</a>
						</div>

						<div class="call">
							<a href="#modal_call" class="modal_link">Перезвоните мне!</a>
						</div>
					</div>
				</div>
			</div>
		</header>

    <?php
	/*
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
   
	*/
   ?>
    <?if ( Yii::$app->request->url !== Yii::$app->homeUrl ):?>
	
		<?if ( strpos(Yii::$app->request->url, 'services')  === false ):?>
			<section class="section_inner">
				<div class="cont">
					<?=
					Breadcrumbs::widget(
						[
							'homeLink' => ['label' => 'Главная', 'url' => '/'],
							'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
							'tag' => 'div',
							'options' => [
								'class' => 'breadcrumbs',//этот класс стоит по умолчанию
								'style' => ''//добавили
							],
							'itemTemplate' => "{link} <span class='step'></span>",
							'activeItemTemplate' => "{link}",
						]
					) ?>
					

					<div class="title_inner"><?= Html::encode($this->title) ?></div>
				</div>
			</section>
			
		<?else:?>
			<section class="section_first">
				<div class="cont">
					<?=
					Breadcrumbs::widget(
						[
							'homeLink' => ['label' => 'Главная', 'url' => '/'],
							'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
							'tag' => 'div',
							'options' => [
								'class' => 'breadcrumbs',//этот класс стоит по умолчанию
								'style' => ''//добавили
							],
							'itemTemplate' => "{link} <span class='step'></span>",
							'activeItemTemplate' => "{link}",
						]
					) ?>

					<div class="title_inner"><?= Html::encode($this->title) ?></div>

					<div class="info">Заполните заявку и мы покажем банки, в которых у вас высокая вероятность получить кредит наличными. У нас 92% отправленых заявок получают одобрение.</div>

					<div class="completed">
						<a href="#completed" class="scroll_link">Заполнить заявку</a>
					</div>
				</div>
			</section>
		
		<?endif;?>
	<?endif;?>
   
   	<section class="sectionMarg">
		<div class="cont">
			<?= $content ?>
		</div>
	</section>


		<footer>
			<div class="cont">
				<div class="logo">
					<a href="/">
						<img src="images/logo.svg" alt="">
					</a>
				</div>

				<div class="line_menu">
					<div class="box_menu">
						<div class="title_menu">Услуги</div>

						<ul class="menu">
							<li>
								<a href="/credit.html">Кредиты</a>
							</li>
							<li>
								<a href="/">Ипотека</a>
							</li>
							<li>
								<a href="/">Автокредиты</a>
							</li>
							<li>
								<a href="/">Страхование</a>
							</li>
							<li>
								<a href="/">РКО</a>
							</li>
						</ul>
					</div>

					<div class="box_menu">
						<div class="title_menu">Продукты</div>

						<ul class="menu">
							<li>
								<a href="/services/credit-cards">Кредитные карты</a>
							</li>
							<li>
								<a href="/">Дебетовые карты</a>
							</li>
							<li>
								<a href="/">Депозиты</a>
							</li>

						</ul>
					</div>

					<div class="box_menu">
						<div class="title_menu">О нас</div>

						<ul class="menu">
							<li>
								<a href="/contacts.html">Контакты</a>
							</li>
							<li>
								<a href="/">Правовая информация</a>
							</li>
							<li>
								<a href="/about">О компании</a>
							</li>
							
						</ul>
					</div>

					<div class="box_menu">
						<div class="title_menu">Партенерам</div>

						<ul class="menu">
							<li>
								<a href="/">Условия сотрудничества</a>
							</li>
							<li>
								<a href="/text_page.html">Условия для Банков</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="line_bottom">
					<div class="copy">&copy; ООО «Выбери», 2018 <br>Все права защищены.</div>

					<div class="links">
						<div class="link">
							<a href="/">Пользовательское соглашение</a>
						</div>

						<div class="link">
							<a href="/">Политика конфиденциальности</a>
						</div>
					</div>

					<div class="social">
						<a href="/" target="_blank" rel="noopener" class="fb"></a>
						<a href="/" target="_blank" rel="noopener" class="ins"></a>
						<a href="/" target="_blank" rel="noopener" class="tg"></a>
						<a href="/" target="_blank" rel="noopener" class="wt"></a>
					</div>

					<div class="created">
						Разработано в <a href="/" target="_blank" rel="noopener"><img src="images/created.png" alt=""></a>
					</div>
				</div>
			</div>
		</footer>
	</div>


	<div class="modal" id="modal_call">
		<div class="title">Заказать обратный звонок</div>

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

	<div class="modal modal_login" id="modal_login">
		<div class="title">Вход</div>

		<div class="form">
			<form action="/lk.html">
				<div class="line_form">
					<input type="text" name="" value="" placeholder="Электронная почта" class="input">
				</div>

				<div class="line_form">
					<input type="password" name="" value="" placeholder="Пароль" class="input">
				</div>

				<div class="submit">
					<input type="submit" value="Войти на сайт" class="submit_btn"> 
				</div>

				<div class="forgot">
					<a href="/">Забыли пароль?</a>
				</div>
			</form>
		</div>
	</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
