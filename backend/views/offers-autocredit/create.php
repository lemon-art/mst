<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersAutocredit */

$this->title = 'Добавить автокредит';
$this->params['breadcrumbs'][] = ['label' => 'Автокредиты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-autocredit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
