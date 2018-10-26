<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Atricles */

$this->title = 'Редактирование статьи: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Atricles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atricles-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
