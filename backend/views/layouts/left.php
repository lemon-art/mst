﻿<?php
use yii\helpers\Html;
?>

<aside class="main-sidebar">

    <section class="sidebar">

		

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Заявки', 'icon' => 'file-code-o', 'url' => ['/orders']],
					['label' => 'Брошенные заявки', 'icon' => 'hand-stop-o', 'url' => ['/lostorders']],
					['label' => 'Заказ звонка', 'icon' => 'phone', 'url' => ['/request']],
					['label' => 'Заказ сотрудничества', 'icon' => 'handshake-o', 'url' => ['/requestp']],
                    ['label' => 'Контент', 'icon' => 'newspaper-o', 'url' => ['/debug'],
						'items' => [
							['label' => 'Предложения', 'icon' => 'star', 'url' => ['/offers-credit'],
								'items' => [
									['label' => 'Кредиты', 'icon' => 'circle-o', 'url' => ['/offers-credit'],],
									['label' => 'Кредитные карты', 'icon' => 'circle-o', 'url' => ['/offers-creditcards'],],
									['label' => 'Автокредит', 'icon' => 'circle-o', 'url' => ['/offers-autocredit'],],
									['label' => 'Ипотека', 'icon' => 'circle-o', 'url' => ['/offers-ipoteka'],],
									['label' => 'Депозиты', 'icon' => 'circle-o', 'url' => ['/offers-deposit'],],
									['label' => 'Дебетовые карты', 'icon' => 'circle-o', 'url' => ['/offers-debetcards'],],
									['label' => 'РКО', 'icon' => 'circle-o', 'url' => ['/offers-rko'],],
								]
							],
							//['label' => 'Предложения', 'icon' => 'circle-o', 'url' => ['/offers'],],
							['label' => 'Услуги', 'icon' => 'circle-o', 'url' => ['/services'],],
							['label' => 'Банки', 'icon' => 'circle-o', 'url' => ['/banks'],],
							['label' => 'Статьи', 'icon' => 'circle-o', 'url' => ['/atricles'],],
							['label' => 'Отзывы', 'icon' => 'circle-o', 'url' => ['/reviews'],],
							['label' => 'Фильтры кредитов', 'icon' => 'circle-o', 'url' => ['/credit-filter'],],
						]
					],
					['label' => 'Страницы', 'icon' => 'sticky-note-o', 'url' => ['/pages']],
					['label' => 'Города', 'icon' => 'fa fa-university', 'url' => ['/city']],
                    ['label' => 'Настройки', 'icon' => 'gear', 'url' => ['/settings'],
						'items' => [
							['label' => 'Пользователи', 'icon' => 'user-o', 'url' => ['/users'],],
							['label' => 'Интеграции API', 'icon' => 'asterisk', 'url' => ['/api'],],
							['label' => 'Настройки сайта', 'icon' => 'dashboard', 'url' => ['/settings'],],
						]
					],
                    
                ],
            ]
        ) ?>

		<button class="btn btn-success" id="tag-help" title="Склонения городов" data-placement="bottom" data-toggle="popover" data-trigger="hover" data-content="
		1{city} - Название, Москва&nbsp;&nbsp;
		2{city-gde} - (где?) в Москве&nbsp;
		3{city-kuda} - (куда?) в Москву
		4{city-kakoi} - (какой?) Московский&nbsp;&nbsp;
		5{city-chego} - (чего?) Москвы"><span class="glyphicon glyphicon-info-sign"></span> Шорт-теги</button>
    </section>

</aside>

<?php
$this->registerJs(<<<JS

    $(document).ready(function() {
       $('[data-toggle="popover"]').popover(); 
    });

JS
	, \yii\web\View::POS_READY);