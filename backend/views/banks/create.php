<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Banks */

$this->title = 'Добавить банк';
$this->params['breadcrumbs'][] = ['label' => 'Банки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banks-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
