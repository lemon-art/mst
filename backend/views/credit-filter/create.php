<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CreditFilter */

$this->title = 'Добавить ссылку и фильтр кредитов';
$this->params['breadcrumbs'][] = ['label' => 'Фильтры кредитов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->category = 0; //популярное по умолчанию
?>
<div class="credit-filter-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
