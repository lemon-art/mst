<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = 'Спецпредложения';
$this->params['breadcrumbs'][] = $this->title;
?>

			<?
				echo ListView::widget([
				    'dataProvider' => $dataProvider,
				    'itemView' => '_services',
					'itemView'     => function ($model, $key, $index, $widget) {
						return $this->render('_services', ['model' => $model, 'index' => $index ]);
					},
				    'layout' => '{items}',
				    'id'           => false,
				    'options' => [
					    'tag'=>'ul',
					    'class' => 'best_categories'
				    ],
				    'itemOptions' => [
					'tag' => false,
				    ],
				    'viewParams' => [
					'fullView' => false,
					'context' => 'main-page',
				    ],
				]);
				?>
		</div>
	

	
						<?
						echo ListView::widget([
							'dataProvider' => $offersProvider,
							'itemView'     => function ($model, $key, $index, $widget) {
								if ( $index == 0 )
									return $this->render('_first_offer', ['model' => $model, 'index' => $index]);
							},
							'layout' => '{items}',
							'id'           => false,
							'emptyText' => '',
							'itemOptions' => [
							'tag' => false,
							],
							'options' => [
								'tag'=>'div',
								'class' => 'super_offer'
							],
							'viewParams' => [
							'fullView' => false,
							'context' => 'main-page',
							// ...
							],
						]);
						?>
						
		<div class="cont">
		
						<?
						echo ListView::widget([
							'dataProvider' => $offersProvider,
							'itemView'     => function ($model, $key, $index, $widget) {
								if ( $index > 0 )
									return $this->render('_all_offer', ['model' => $model, 'index' => $index]);
							},
							'layout' => '{items}',
							'id'           => false,
							'emptyText' => 'Приносим извинения, информация обновляется. Скоро мы все запустим. Телефон для связи: +7 (495) 120-62-00',
							'itemOptions' => [
							'tag' => false,
							],
							'options' => [
								'tag'=>'div',
								'class' => 'best_month'
							],
							'viewParams' => [
							'fullView' => false,
							'context' => 'main-page',
							// ...
							],
						]);
						?>
	

		
		
		

