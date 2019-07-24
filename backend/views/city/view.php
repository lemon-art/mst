<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sity */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sity-view">

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
            'dec1',
            'dec2',
            'dec3',
			'dec4',
            'subdomain',
        ],
    ]) ?>

</div>
