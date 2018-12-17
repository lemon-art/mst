<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */

$this->title = 'Редактировать страницу: ' . $model->h1;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="pages-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
