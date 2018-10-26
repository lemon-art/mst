<?php
use eugenekei\news\Module;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model eugenekei\news\models\News */

$htmlPurifierOptions = [
    'HTML.SafeIframe' => true,
    'Attr.AllowedFrameTargets' => ['_blank', '_self', '_parent', '_top'],
    'URI.SafeIframeRegexp' =>
        '%^(https?:)?//(www.youtube.com/embed/|player.vimeo.com/video/|vk.com/video)%',
];
?>
<article>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]) ?></h2>
        </div>
        <div class="panel-body">
            <div class="annonce">
                <?= HtmlPurifier::process($model->annonce, $htmlPurifierOptions) ?>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-6">
            <?= Html::a(Module::t('eugenekei-news', 'Read more...'), ['view', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']) ?>
                </div>
                <div class="col-md-6">
            <?= Html::tag('time', Yii::$app->formatter->asDatetime($model->created_at),
                [
                    'datetime' => Yii::$app->formatter->asDatetime($model->created_at, 'php:c'),
                    'class' => 'badge pull-right',
                    'pubdate' => 'pubdate',
                ]) ?>
                </div>
            </div>
        </div>
    </div>
</article>