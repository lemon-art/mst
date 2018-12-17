<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Files;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">


    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Добавить отзыв', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
				'attribute' => 'name',
				'format' => 'raw',
				'value' => function($model){
					return Html::a($model->name,['update', 'id' => $model->id]);
				},
			],
			[
					'label' => 'Фото',
					'format' => 'raw',
					'value' => function($data){
						if ( $data->image ) {
							return Html::img(Files::getPath($data->image),[
								'alt'=>'картинка',
								'style' => 'width:100px;'
							]);
						}
					},
			],
            [
				'class' => \yii\grid\ActionColumn::className(),
				'template'=>'{delete}',
			]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
