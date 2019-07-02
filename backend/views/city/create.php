<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sity */

$this->title = 'Добавить город';
$this->params['breadcrumbs'][] = ['label' => 'Sities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sity-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
