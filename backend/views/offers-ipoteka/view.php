<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OffersIpoteka */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ипотека', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-ipoteka-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'activ',
            'special',
            'main_page',
            'bank_id',
            'rate',
            'link',
            'preview_text:ntext',
            'image',
            'sort',
            'initial_payment',
            'min_summ_ipoteka',
            'max_summ_ipoteka',
        ],
    ]) ?>

</div>
