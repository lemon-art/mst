<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Files;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BanksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Банки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banks-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить банк', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            	[
					'label' => 'Логотип',
					'format' => 'raw',
					'value' => function($data){
						return Html::img(Files::getPath($data->image),[
							'alt'=>'картинка',
							'style' => 'width:100px;'
						]);
					},
				],
				[
					'attribute' => 'name',
					'format' => 'raw',
					'value' => function($model){
						return Html::a($model->name,['update', 'id' => $model->id]);
					},
	 
				],
				[
					'attribute' => 'active',
					'format' => 'raw',
					'options' => ['style' => 'width: 65px; max-width: 65px;'],
					'value' => function($model){
						if ( $model->active ){
							return 'да';
						}
						else {
							return 'нет';
						}
					},
				],
				'code',
				[
					'attribute' => 'priority',
					'format' => 'raw',
					'options' => ['style' => 'width: 80px; max-width: 80px;'],
					'value' => function($model){
						if ($model->priority >= 2){
							return 'Высокий';
						} elseif ($model->priority == 1) {
							return 'Средний';
						} else {
							return 'Низкий';
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
