<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sity */

$this->title = 'Изменить город: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sity-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
