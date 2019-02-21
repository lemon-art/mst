<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Api */

$this->title = 'Редактировать Api';
$this->params['breadcrumbs'][] = ['label' => 'Api', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


