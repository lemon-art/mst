<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\components\PopupForm;
use frontend\components\Login;
use frontend\components\Register;
use frontend\components\Forgot;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<meta name="SKYPE_TOOLBAR" content ="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	<link rel="icon" type="image/png" href="/favicon.png" />
	<link rel="stylesheet" href="/css/response_1023.css" media="(max-width: 1023px)">
	<link rel="stylesheet" href="/css/response_767.css" media="(max-width: 767px)">
	<link rel="stylesheet" href="/css/response_479.css" media="(max-width: 479px)">
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
						<form action="/search">
							<input type="text" name="q" value placeholder="Найдется все" class="search left">

							<input type="submit" value="" class="search_btn left">
							<div class="clear"></div>
						</form>
					</div>

					<div class="contact">
						<div class="tel">
							<a href="tel:+74951206200">+7 (495) 120-62-00</a>
						</div>

						<div class="call">
							<a href="#modal_call" class="modal_link">Перезвоните мне!</a>
						</div>
					</div>
					
					<div class="login">
						<?php if (Yii::$app->user->isGuest): ?>
							<a href="#modal_login" class="modal_link">
								<span>Вход</span>
							</a>
						<?else:?>
							<a href="/personal" class="">
								<span>Личный кабинет</span>
							</a>

						<?endif;?>
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
						<form action="/search">
							<input type="text" name="q" value placeholder="Найдется все" class="search left">

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
                        <a href="/services/rko">
                            <span>РКО</span>
                        </a>
						<a href="/specoffers">
							<span>Спецпредложения</span>
						</a>

					</nav>

					<div class="contact">
						<div class="tel">
							<a href="tel:+74951206200">+7 (495) 120-62-00</a>
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
			
			<section class="sectionMarg">
				<div class="cont">
					<?= $content ?>
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

					
		
			<?= $content ?>
		<?endif;?>
		

		
		
	<?else:?>
	
		<?= $content ?>

	<?endif;?>
   



		<footer>
			<div class="cont">
				<div class="logo">
					<a href="/">
						<img src="/images/logo.png" alt="">
					</a>
				</div>

				<div class="line_menu">
					<div class="box_menu">
						<div class="title_menu">Услуги</div>

						<ul class="menu">
							<li>
								<a href="/services/credit">Кредиты</a>
							</li>
							<li>
								<a href="/services/ipoteka">Ипотека</a>
							</li>
							<li>
								<a href="/services/credit-auto">Автокредиты</a>
							</li>
							<li>
								<a href="/services/rko">РКО</a>
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
								<a href="/services/debet-cards">Дебетовые карты</a>
							</li>
							<li>
								<a href="/services/deposit">Депозиты</a>
							</li>

						</ul>
					</div>

					<div class="box_menu">
						<div class="title_menu">О нас</div>

						<ul class="menu">
							<li>
								<a href="/contacts">Контакты</a>
							</li>
							<li>
								<a href="/about">О сервисе</a>
							</li>
							
						</ul>
					</div>

					<div class="box_menu">
						<div class="title_menu">Партнёрам</div>

						<ul class="menu">
							<li>
								<a href="/terms_of_cooperation">Условия сотрудничества</a>
							</li>
							<li>
								<a href="/terms_of_banks">Условия для Банков</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="line_bottom">
					<div class="copy">&copy; ООО «Айкодек», <?=date('Y')?> <br>Все права защищены.</div>

					<div class="links">
						<div class="link">
							<a href="/rules">Пользовательское соглашение</a>
						</div>

						<div class="link">
							<a href="/policy">Политика конфиденциальности</a>
						</div>
					</div>

					<?/*
					<div class="social">
						<a href="/" target="_blank" rel="noopener" class="fb"></a>
						<a href="/" target="_blank" rel="noopener" class="ins"></a>
						<a href="/" target="_blank" rel="noopener" class="tg"></a>
						<a href="/" target="_blank" rel="noopener" class="wt"></a>
					</div>
					*/?>
					
					<div class="created">
						Разработано в <a href="/" target="_blank" rel="noopener"><img src="/images/created.png" alt=""></a>
					</div>
				</div>
			</div>
		</footer>
	</div>


	<div class="modal" id="modal_call">
		<?=PopupForm::widget();?>
	</div>

	<div class="modal modal_login" id="modal_login">
		<?=Login::widget();?>
	</div>
	
	<div class="modal modal_login" id="modal_register">
		<?=Register::widget();?>
	</div>
	
	<div class="modal modal_login" id="modal_forgot">
		<?=Forgot::widget();?>
	</div>

<?php $this->endBody() ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(52131253, "init", {
        id:52131253,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52131253" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
<?php $this->endPage() ?>
