<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OffersRko */

$this->title = 'Добавить РКО';
$this->params['breadcrumbs'][] = ['label' => 'РКО', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->sort = 1; //средний приоритет по умолчанию
?>
<div class="offers-rko-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
