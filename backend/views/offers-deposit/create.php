<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersDeposit */

$this->title = 'Create Offers Deposit';
$this->params['breadcrumbs'][] = ['label' => 'Offers Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-deposit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
