<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersDebetcards */

$this->title = 'Create Offers Debetcards';
$this->params['breadcrumbs'][] = ['label' => 'Offers Debetcards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-debetcards-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
