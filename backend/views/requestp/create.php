<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Requestp */

$this->title = 'Create Requestp';
$this->params['breadcrumbs'][] = ['label' => 'Requestps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requestp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
