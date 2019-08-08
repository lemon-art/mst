<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersRko */

$this->title = 'Create Offers Rko';
$this->params['breadcrumbs'][] = ['label' => 'Offers Rkos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-rko-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
