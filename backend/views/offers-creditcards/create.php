<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersCreditcards */

$this->title = 'Добавить кредитную карту';
$this->params['breadcrumbs'][] = ['label' => 'Кредитные карты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-creditcards-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
