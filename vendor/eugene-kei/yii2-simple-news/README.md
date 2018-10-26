Модуль новостей для Yii2
================================
Простой модуль новостей для `yii2-app-advanced`


Модуль использует виджет [vova07/yii2-imperavi-widget](https://github.com/vova07/yii2-imperavi-widget).

Поддерживает изображения в тексте новости и возможность вставить видео с *youtube.com*, *vk.com* и *vimeo.com*.


Установка
---------



Добавьте

```
"eugene-kei/yii2-simple-news": "*"
```

В файл **composer.json** вашего приложения.




Выполните

```
composer updete
```




Далее, необходимо выполнить миграцию

```
yii migrate --migrationPath=@eugenekei/news/migrations
```




Настройка
---------


В файле **frontend/config/main.php**

```
'modules' => [
        //...
        'news' => [
            'class' => 'eugenekei\news\Module',
        ]
        //...
    ],
```




Поумолчанию, изображения сохраняются в `@frontend/web/images/news`, поэтому, для того, чтобы иметь доступ к изображениям
из бэкенда, необходимо указать полный url дирректории с изображениями (свойство `imageGetUrl`), в файле

**backend/config/main.php**

```
'modules' => [
        //...
        'news' => [
            'class' => 'eugenekei\news\Module',
            'controllerNamespace' => 'eugenekei\news\controllers\backend',
            'imageGetUrl' => 'http://my-frontend.ru/images/news/'
        ]
        //...
    ],
```

Или же, можно, создать симлинк `@backend/web/images/news` на `@frontend/web/images/news`.


