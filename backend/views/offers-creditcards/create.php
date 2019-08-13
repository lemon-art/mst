<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersCreditcards */

$this->title = 'Добавить кредитную карту';
$this->params['breadcrumbs'][] = ['label' => 'Кредитные карты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->sort = 1; //средний приоритет по умолчанию
?>
<div class="offers-creditcards-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
