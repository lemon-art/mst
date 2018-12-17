<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

$this->title = 'Добавление отзыва';
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
