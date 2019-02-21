<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Api */

$this->title = 'Добавление Api';
$this->params['breadcrumbs'][] = ['label' => 'Api', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


