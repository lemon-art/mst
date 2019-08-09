<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersCredit */

$this->title = 'Добавить кредит';
$this->params['breadcrumbs'][] = ['label' => 'Кредиты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-credit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
