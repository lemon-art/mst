<?php

use eugenekei\news\Module;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eugenekei\news\models\News */

$this->title = Html::encode($model->title);
$this->params['subtitle'] = Module::t('eugenekei-news', 'Update News');
$this->params['breadcrumbs'][] = [
    'label' => Module::t('eugenekei-news', 'News'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->params['subtitle'];
?>
<div class="news-create">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= $this->title ?> <small><?=$this->params['subtitle']?></small></h1>
            <div class="text-right">
                <?= Html::a('<i class="glyphicon glyphicon-list"></i>', ['index'],
                    [
                        'class' => 'btn btn-default btn-sm',
                        'title' => Module::t('eugenekei-news', 'List')
                    ]); ?>
                <?= Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['view', 'id' => $model->id],
                    [
                        'class' => 'btn btn-default btn-sm',
                        'title' => Module::t('eugenekei-news', 'View')
                    ]); ?>
                <?= Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    [
                        'class' => 'btn btn-primary btn-sm',
                        'title' => Module::t('eugenekei-news', 'Create')
                    ]); ?>
                <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['delete', 'id' => $model->id],
                    [
                        'class' => 'btn btn-danger btn-sm',
                        'title' => Module::t('eugenekei-news', 'Delete'),
                        'data-confirm' => Module::t('eugenekei-news', 'Are you sure to delete this item?'),
                        'data-method' => 'post',
                    ]); ?>
            </div>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
                'box' => $box,
            ]); ?>
        </div>
    </div>
</div>