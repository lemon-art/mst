<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Files;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AtriclesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="atricles-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить статью', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
				
				[
					'attribute' => 'name',
					'format' => 'raw',
					'value' => function($model){
						return Html::a($model->name,['update', 'id' => $model->id]);
					},
	 
				],
			'date',
			[
				'label' => 'Картинка',
				'format' => 'raw',
				'value' => function($data){
					if ( $data->image ){
						return Html::img(Files::getPath($data->image),[
							'alt'=>'картинка',
							'style' => 'width:100px;'
						]);
					}
					else {
						return '';
					}
				},
			],
			[
				'attribute' => 'preview_text',
				'format' => 'raw',
				'options' => ['style' => 'width: 400px; max-width: 450px;'],
				'value' => function($model){
					$model->preview_text = mb_substr($model->preview_text, 0, 45).'...';
					return $model->preview_text;
				},
			],
			'id',
            [
				'class' => \yii\grid\ActionColumn::className(),
				'template'=>'{delete}',
			]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
