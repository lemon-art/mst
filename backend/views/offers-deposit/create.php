<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersDeposit */

$this->title = 'Добавить депозит';
$this->params['breadcrumbs'][] = ['label' => 'Депозиты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->sort = 1; //средний приоритет по умолчанию
?>
<div class="offers-deposit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
