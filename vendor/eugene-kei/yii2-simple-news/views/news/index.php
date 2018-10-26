<?php

use eugenekei\news\Module;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel eugenekei\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('eugenekei-news', 'News');
$this->params['subtitle'] = Module::t('eugenekei-news', 'List News');
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->params['subtitle'];

$gridId = 'news-grid';

?>
<div class="<?= $gridId ?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= $this->title ?></h1>
        </div>
    </div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_item'
    ]) ?>
</div>
