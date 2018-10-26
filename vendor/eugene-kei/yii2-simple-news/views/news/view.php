<?php

use eugenekei\news\Module;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model eugenekei\news\models\News */

$this->title = Html::encode($model->title);
$this->params['subtitle'] = Module::t('eugenekei-news', 'View News');
$this->params['breadcrumbs'][] = [
    'label' => Module::t('eugenekei-news', 'News'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->params['subtitle'];

$htmlPurifierOptions = [
    'HTML.SafeIframe' => true,
    'Attr.AllowedFrameTargets' => ['_blank', '_self', '_parent', '_top'],
    'URI.SafeIframeRegexp' =>
        '%^(https?:)?//(www.youtube.com/embed/|player.vimeo.com/video/|vk.com/video)%',
];
?>
<article class="news-view">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= $this->title ?></h1>
        </div>
        <div class="panel-body">
            <div class="news-content">
                <?= HtmlPurifier::process($model->content, $htmlPurifierOptions) ?>
            </div>
        </div>
        <div class="panel-footer">
                    <?= Html::tag('time', Yii::$app->formatter->asDatetime($model->created_at),
                        [
                            'datetime' => Yii::$app->formatter->asDatetime($model->created_at, 'php:c'),
                            'class' => 'badge',
                            'pubdate' => 'pubdate',
                        ]) ?>
        </div>
    </div>
</article>
