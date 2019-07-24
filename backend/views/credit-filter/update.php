<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CreditFilter */

$this->title = 'Изменить ссылку и фильтр кредитов: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Фильтры кредитов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="credit-filter-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
