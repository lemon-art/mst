<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
?>	


		<section class="sectionMarg">
			<div class="cont">

				 <div class="main_title">Выгодное предложение</div>

				<div class="table_profitably">


					<div class="item_head">
						<div class="box">Банк и название продукта</div>
 
						<div class="box small">Обслуживание</div>
                        <div class="box small">Открытие счета</div>
						<div class="box " style="width: 40%">Преимущества</div>
					</div>

						<?
						echo ListView::widget([
							'dataProvider' => $offersProvider,
							'itemView'     => function ($model, $key, $index, $widget) {
								return $this->render('_offers_7', ['model' => $model, 'index' => $index+1]);
							},
							'layout' 	  => '{items}',
							'id'          => false,
							'emptyText'   => 'Приносим извинения, информация обновляется. Скоро мы все запустим. Телефон для связи: +7 (495) 120-62-00',
							'itemOptions' => [
							'tag' => false,
							],
							'options' => [
								'tag'=>'div',
								'class' => 'mob_profitably owl-carousel'
							],
							'viewParams' => [
							'fullView' => false,
							'context' => 'main-page',
							// ...
							],
						]);
						?>

					
						

						
				</div>
			</div>
		</section>