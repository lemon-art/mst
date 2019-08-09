<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OffersAutocredit */

$this->title = 'Изменить автокредит: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Автокредиты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="offers-autocredit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
