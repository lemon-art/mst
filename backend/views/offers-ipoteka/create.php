<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersIpoteka */

$this->title = 'Добавить ипотеку';
$this->params['breadcrumbs'][] = ['label' => 'Ипотека', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-ipoteka-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
