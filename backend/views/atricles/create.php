<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Atricles */

$this->title = 'Добавление статьи';
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atricles-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
