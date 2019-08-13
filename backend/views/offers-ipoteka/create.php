<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersIpoteka */

$this->title = 'Добавить ипотеку';
$this->params['breadcrumbs'][] = ['label' => 'Ипотека', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->sort = 1; //средний приоритет по умолчанию
?>
<div class="offers-ipoteka-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
