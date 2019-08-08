<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersCreditcards */

$this->title = 'Create Offers Creditcards';
$this->params['breadcrumbs'][] = ['label' => 'Offers Creditcards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-creditcards-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
