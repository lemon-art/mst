<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Atricles */

$this->title = 'Create Atricles';
$this->params['breadcrumbs'][] = ['label' => 'Atricles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atricles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
