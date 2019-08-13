<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersCredit */

$this->title = 'Добавить кредит';
$this->params['breadcrumbs'][] = ['label' => 'Кредиты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->sort = 1; //средний приоритет по умолчанию
?>
<div class="offers-credit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
