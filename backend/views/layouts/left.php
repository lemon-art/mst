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
							['label' => 'Предложения', 'icon' => 'circle-o', 'url' => ['/offers'],],
							['label' => 'Услуги', 'icon' => 'circle-o', 'url' => ['/services'],],
							['label' => 'Банки', 'icon' => 'circle-o', 'url' => ['/banks'],],
							['label' => 'Статьи', 'icon' => 'circle-o', 'url' => ['/atricles'],],
							['label' => 'Отзывы', 'icon' => 'circle-o', 'url' => ['/reviews'],],
							
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
		
		<a href="#" class="btn btn-success" id="tag-help" title="Склонения городов" data-placement="bottom" data-toggle="popover" data-trigger="hover" data-content="Название города, Пример: Москва<br>
2. {city-gde} - Склонение (где?) Пример: в Москве<br>
3. {city-kuda} - Склонение (куда?) Пример: в Москву <br>
4. {city-kakoi} - Склонение (какой?) Пример: Московский<br>
5. {city-chego} - Склонение (чего?) Пример: Москвы">Шорт-теги <span class="glyphicon glyphicon-info-sign"></span></a>
    </section>

</aside>

<?php
$this->registerJs(<<<JS

    $(document).ready(function() {
       $('[data-toggle="popover"]').popover(); 
    });

JS
	, \yii\web\View::POS_READY);