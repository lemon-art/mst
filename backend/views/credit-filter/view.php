<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CreditFilter */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-filter-view">

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
            'code',
            'title',
            'description',
            'name',
            'top_text',
            'seo_text',
            'bank_id',
            'term',
            'summ',
            'rate',
        ],
    ]) ?>

</div>
