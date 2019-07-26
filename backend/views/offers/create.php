<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Offers */

$this->title = 'Добавить предложение';
$this->params['breadcrumbs'][] = ['label' => 'Предложения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->sort = 1; //средний приоритет по умолчанию
?>
<div class="offers-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
