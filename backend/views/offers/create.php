<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Offers */

$this->title = 'Добавить предложение';
$this->params['breadcrumbs'][] = ['label' => 'Предложения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
