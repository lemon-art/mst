<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\components\PopupForm;
use frontend\components\Login;
use frontend\components\Register;
use frontend\components\Forgot;
use frontend\components\HelpOrder;
use backend\models\City;
use yii\bootstrap\Modal;

AppAsset::register($this);

if (isset($_GET["actionpay"])){
    setcookie("actionpay", $_GET["actionpay"], time()+60*60*24*30);
}

//текущий город
$subdomain = current(explode('.', $_SERVER['HTTP_HOST']));
$city = '';
if ($subdomain == 'dev' || $subdomain == 'marketvibor') {
	$city['dec1'] = 'в России';
} else {
	$city = City::find()->where(['subdomain' => $subdomain])->one();
	$city = (array)$city;
	$city = current($city);
	if (!$city) {
		header('Location: http://marketvibor.ru'.Yii::$app->request->url);
		$city['dec1'] = 'в России';
	} 
}



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<?php echo $this->render('_head') ?>


<script src="https://www.artfut.com/static/tagtag.min.js?campaign_code=cb5beacf10" async onerror="var self = this;window.ADMITAD=window.ADMITAD||{},ADMITAD.Helpers=ADMITAD.Helpers||{},ADMITAD.Helpers.generateDomains=function(){for(var e=new Date,n=Math.floor(new Date(2020,e.getMonth(),e.getDate()).setUTCHours(0,0,0,0)/1e3),t=parseInt(1e12*(Math.sin(n)+1)).toString(30),i=["de"],o=[],a=0;a<i.length;++a)o.push({domain:t+"."+i[a],name:t});return o},ADMITAD.Helpers.findTodaysDomain=function(e){function n(){var o=new XMLHttpRequest,a=i[t].domain,D="https://"+a+"/";o.open("HEAD",D,!0),o.onload=function(){setTimeout(e,0,i[t])},o.onerror=function(){++t<i.length?setTimeout(n,0):setTimeout(e,0,void 0)},o.send()}var t=0,i=ADMITAD.Helpers.generateDomains();n()},window.ADMITAD=window.ADMITAD||{},ADMITAD.Helpers.findTodaysDomain(function(e){if(window.ADMITAD.dynamic=e,window.ADMITAD.dynamic){var n=function(){return function(){return self.src?self:""}}(),t=n(),i=(/campaign_code=([^&]+)/.exec(t.src)||[])[1]||"";t.parentNode.removeChild(t);var o=document.getElementsByTagName("head")[0],a=document.createElement("script");a.src="https://www."+window.ADMITAD.dynamic.domain+"/static/"+window.ADMITAD.dynamic.name.slice(1)+window.ADMITAD.dynamic.name.slice(0,1)+".min.js?campaign_code="+i,o.appendChild(a)}});"></script>
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

					<div class="city">
						<div id="user-city"></div>
						<?php 
						$cities = City::find()->select('name, subdomain')->all(); //список городов
						asort($cities);
						$column = count($cities) / 3;
						ceil($column);
						
						
						
						Modal::begin([
							'header' => '<h2>Выберите ваш город</h2>',
							'toggleButton' => [
								'label' => $city['dec1'],
								'tag' => 'button',
								'class' => 'btn btn-default btn-city'
								],					
							]); ?>

							<div class="row">
								<div class="col-sm-4">
									<?php foreach ($cities as $key => $arr) {							
										$urlName = $arr->subdomain;
										$homeUrl = '.marketvibor.ru'; ?> 
										<a href="http://<?= $urlName.$homeUrl ?>"><?= $arr->name ?><br></a>
										<?php if ($key == $column || $key == $column * 2) {
											echo '</div><div class="col-sm-4">';
										}
									} ?>
								</div>
							</div>
						<?php Modal::end(); ?>
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
						<a href="/services/credit/">
							<span>Кредиты</span>
						</a>
						<a href="/services/ipoteka/">
							<span>Ипотека</span>
						</a>
						<a href="/services/deposit/">
							<span>Депозиты</span>
						</a>
						<a href="/services/credit-cards/">
							<span>Кредитные карты</span>
						</a>
						<a href="/services/debet-cards/">
							<span>Дебетовые карты</span>
						</a>
						<a href="/services/credit-auto/">
							<span>Автокредиты</span>
						</a>
                        <a href="/services/rko/">
                            <span>РКО</span>
                        </a>
						<a href="/specoffers/">
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
								<a href="/services/credit/">Кредиты</a>
							</li>
							<li>
								<a href="/services/ipoteka/">Ипотека</a>
							</li>
							<li>
								<a href="/services/credit-auto/">Автокредиты</a>
							</li>
							<li>
								<a href="/services/rko/">РКО</a>
							</li>
						</ul>
					</div>

					<div class="box_menu">
						<div class="title_menu">Продукты</div>

						<ul class="menu">
							<li>
								<a href="/services/credit-cards/">Кредитные карты</a>
							</li>
							<li>
								<a href="/services/debet-cards/">Дебетовые карты</a>
							</li>
							<li>
								<a href="/services/deposit/">Депозиты</a>
							</li>

						</ul>
					</div>

					<div class="box_menu">
						<div class="title_menu">О нас</div>

						<ul class="menu">
							<li>
								<a href="/contacts/">Контакты</a>
							</li>
							<li>
								<a href="/about/">О сервисе</a>
							</li>
							
						</ul>
					</div>

					<div class="box_menu">
						<div class="title_menu">Партнёрам</div>

						<ul class="menu">
							<li>
								<a href="/terms_of_cooperation/">Условия сотрудничества</a>
							</li>
							<li>
								<a href="/terms_of_banks/">Условия для Банков</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="line_bottom">
					<div class="copy">2019 © МаркетВыбор.<br>Все права защищены.</div>

					<div class="links">
						<div class="link">
							<a href="/rules/">Пользовательское соглашение</a>
						</div>

						<div class="link">
							<a href="/policy/">Политика конфиденциальности</a>
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
					<div class="contact">
						<div class="tel">
						<a href="tel:+74951206200">+7 (495) 120-62-00</a>
						</div>
						
						<div class="call">
							<a href="#modal_call" class="modal_link">Перезвоните мне!</a>
						</div>
					</div>
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
	
	<div class="modal modal_login" id="modal_help">
		<?=HelpOrder::widget();?>
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

<script type="text/javascript">
    (function (w, d) {
        try {
            var el = 'getElementsByTagName', rs = 'readyState';
            if (d[rs] !== 'interactive' && d[rs] !== 'complete') {
                var c = arguments.callee;
                return setTimeout(function () { c(w, d) }, 100);
            }
            var s = d.createElement('script');
            s.type = 'text/javascript';
            s.async = s.defer = true;
            s.src = '//aprtx.com/code/Marketvibor/';
            var p = d[el]('body')[0] || d[el]('head')[0];
            if (p) p.appendChild(s);
        } catch (x) { if (w.console) w.console.log(x); }
    })(window, document);
</script>

<!-- Top100 (Kraken) Counter -->
<script>
    (function (w, d, c) {
    (w[c] = w[c] || []).push(function() {
        var options = {
            project: 6537981,
        };
        try {
            w.top100Counter = new top100(options);
        } catch(e) { }
    });
    var n = d.getElementsByTagName("script")[0],
    s = d.createElement("script"),
    f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src =
    (d.location.protocol == "https:" ? "https:" : "http:") +
    "//st.top100.ru/top100/top100.js";

    if (w.opera == "[object Opera]") {
    d.addEventListener("DOMContentLoaded", f, false);
} else { f(); }
})(window, document, "_top100q");
</script>
<noscript>
  <img src="//counter.rambler.ru/top100.cnt?pid=6537981" alt="Топ-100" />
</noscript>
<!-- END Top100 (Kraken) Counter -->
<!--LiveInternet counter--><script type="text/javascript">
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,150))+";"+Math.random()+
"' alt='' style='display:none;' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
</script><!--/LiveInternet-->
<!-- Rating@Mail.ru counter -->
<script type="text/javascript">
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "3083494", type: "pageView", start: (new Date()).getTime()});
(function (d, w, id) {
  if (d.getElementById(id)) return;
  var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
  ts.src = "https://top-fwz1.mail.ru/js/code.js";
  var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "topmailru-code");
</script><noscript><div>
<img src="https://top-fwz1.mail.ru/counter?id=3083494;js=na" style="border:0;position:absolute;left:-9999px;" alt="Top.Mail.Ru" />
</div></noscript>
<!-- //Rating@Mail.ru counter -->

</body>
<script type="text/javascript" >
	//шорт тег в title
	$(document).ready(function(){
		var content = $('title').html();	
		document.title = content.replace(/{city_dec4}/gi, "<?php if ($city['dec4']) { echo '1'; } ?>");
	
	});
</script>
</html>
<?php $this->endPage() ?>
