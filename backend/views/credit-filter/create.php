<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sity */

$this->title = 'Добавить ссылку и фильтр кредита';
$this->params['breadcrumbs'][] = ['label' => 'Sities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sity-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
