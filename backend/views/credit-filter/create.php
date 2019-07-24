<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CreditFilter */

$this->title = 'Добавить ссылку и фильтр кредитов';
$this->params['breadcrumbs'][] = ['label' => 'CreditFilter', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-filter-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
