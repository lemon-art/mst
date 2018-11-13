<aside class="main-sidebar">

    <section class="sidebar">




        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Заказы', 'icon' => 'file-code-o', 'url' => ['/orders']],
                    ['label' => 'Контент', 'icon' => 'newspaper-o', 'url' => ['/debug'],
						'items' => [
							['label' => 'Предложения', 'icon' => 'circle-o', 'url' => ['/offers'],],
							['label' => 'Услуги', 'icon' => 'circle-o', 'url' => ['/services'],],
							['label' => 'Банки', 'icon' => 'circle-o', 'url' => ['/banks'],],
							['label' => 'Статьи', 'icon' => 'circle-o', 'url' => ['/atricles'],],
							
						]
					],
                    ['label' => 'Настройки', 'icon' => 'gear', 'url' => ['/settings'],
						'items' => [
							['label' => 'Пользователи', 'icon' => 'file-code-o', 'url' => ['/gii'],],
							['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
						]
					],
                    
                ],
            ]
        ) ?>

    </section>

</aside>
