<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
$this->title = 'Результаты поиска';
?>

		<section class="sectionMarg">
			<div class="cont">
			
				<div class="form_search form">
					<form>
						<input type="text" value="<?=$q?>" name="q" value placeholder="Найдется все" class="search left">

						<input type="submit" value="Искать" class="submit_btn">
						<div class="clear"></div>
					</form>
				</div>
			
			</div>
		</section>


		<section class="sectionMarg">
			<div class="cont">
					
					<?
					if ( $q ){
						echo ListView::widget([
							'dataProvider' => $offersProvider,
							'itemView' => '_best_offers',
							'layout' => '{items}',
							'emptyText' => '',
							'id'           => false,
							'options' => [
								'tag'=>'div',
								'class' => 'best_month'
							],
							'itemOptions' => [
							'tag' => false,
							],
							'viewParams' => [
							'fullView' => false,
							'context' => 'main-page',
							],
						]);
					}
					?>


			</div>
		</section>

		
		<section class="sectionMarg">
			<div class="cont">
									
					<?
					global $searchFind;
					if ( $searchFind ){
						$emptyText = '';
					}
					else {
						$emptyText = 'Ничего не найдено.';
					}
					
					if ( $q ){
					
						echo ListView::widget([
							'dataProvider' => $searchProvider,
							'itemView' => '_search_result',
							'layout' => '{items}{pager}',
							'id'           => false,
							'emptyText' => $emptyText,
							'options' => [
								'tag'=>'div',
								'class' => 'search_result'
							],

							'itemOptions' => [
							'tag' => false,
							],
							'viewParams' => [
								'fullView' => false,
							],
						]);
						
					}
					else {
						echo "<p>Введите поисковый запрос.</p>";
					}
					?>


			</div>
		</section>

		
		
	
	
