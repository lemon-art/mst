<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OffersDebetcards */

$this->title = 'Изменить дебетовую  карту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Дебетовые карты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="offers-debetcards-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
