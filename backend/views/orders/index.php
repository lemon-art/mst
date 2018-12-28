<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	
	<div class="col-md-12">
		<div class="box box-info">

		<?php Pjax::begin(); ?>
		<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

			<div class="box-body">
			    <div class="table-responsive">
					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'layout' => '{items}{pager}',
						//'filterModel' => $searchModel,
						'columns' => [
							[
								'attribute' => 'id',
								'format' => 'raw',
								'options' => ['style' => 'width: 65px; max-width: 65px;'],
								'value' => function($model){
									return Html::a($model->id,['view', 'id' => $model->id]);
								},
							],
							'date',
							[
								'attribute' => 'fullName',
								'format' => 'raw',
								'value' => function($model){
									return Html::a($model->fullName,['view', 'id' => $model->id]);
								},
							],
							[
								'attribute' => 'serviceName',
								'format' => 'raw',
								'value' => function($model){
									return Html::a('Заявка на ' . $model->services->short_name,['view', 'id' => $model->id]);
								},
							],
							'statusName',
							/*
							[
								'attribute' => 'summ',
								'format' => 'raw',
								'value' => function($model){
									return number_format($model->summ, 0, '', ' ');
								},
							],
							'term',
							'city',
							'phone',
							'email',
							*/
							//'summ',
							//'term',
							//'city',
							//'employment',
							//'work_month',
							//'work_year',
							//'income',
							//'provision',
							//'have_auto',
							//'service_id',
							//'user_id',

							[
								'class' => \yii\grid\ActionColumn::className(),
								'template'=>'{delete}',
							]
						],
					]); ?>
					</div>		
				</div>
					
			<?php Pjax::end(); ?>
			
		</div>		
	</div>		
</div>
