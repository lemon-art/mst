<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OffersDeposit */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Offers Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-deposit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'activ',
            'bank_id',
            'name',
            'rate',
            'preview_text:ntext',
            'image',
            'special',
            'sort',
            'main_page',
            'depozit_term',
            'depozit_summ',
            'link',
        ],
    ]) ?>

</div>
