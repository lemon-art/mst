<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use backend\models\Files;
use frontend\components\ShortTag;

$this->title = 'Подбор кредита {city-gde} - MarketVibor';
$description = 'Подберите кредит {city-gde}, 89% отправленных заявок на кредит, получают предварительное одобрение!';

//шорт теги
$this->title = ShortTag::cityTag($this->title);
$description = ShortTag::cityTag($description);

$kreditModel->text_main_title = ShortTag::cityTag($kreditModel->text_main_title);
$kreditModel->text_main_text = ShortTag::cityTag($kreditModel->text_main_text);



$this->registerMetaTag(['name' => 'description', 'content' => $description]);

?>

			<section class="section_first">
				<div class="cont">

					<div class="title_inner"><?= Html::encode($kreditModel->text_main_title) ?></div>			



					<div class="info"><?=$kreditModel->text_main_text?></div>

					<div class="completed">
						<a href="/services/credit/#completed" class="scroll_link">Заполнить заявку</a>
					</div>
				</div>
			</section>
			
<?if ( $kreditModel->text_main_img ):?>		
<?$imgFon = Files::getPath($kreditModel->text_main_img);?>
<?
$script = <<< JS
    jQuery('.section_first').css({ 'background': 'url($imgFon) 0 0 no-repeat' });
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>	
<?endif;?>


		<section class="section_amenities">
			<div class="cont">
				<div class="main_title">Выберите свою услугу</div>
				
					<?
					echo ListView::widget([
						'dataProvider' => $servicesProvider,
						'itemView' => '_services',
						'layout' => '{items}',
						'id'           => false,
						'options' => [
							'tag'=>'div',
							'class' => 'amenities owl-carousel'
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
			</div>
		</section>

		<section class="sectionMarg">
			<div class="cont">
				<div class="main_title">Спецпредложения месяца</div>

					
					<?
					echo ListView::widget([
						'dataProvider' => $bestOffersProvider,
						'itemView' => '_best_offers',
						'layout' => '{items}',
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
					?>

				
				<div class="more_all">
					<a href="/specoffers">Смотреть все</a>
				</div>
			</div>
		</section>

		
		<?= $this->render('_request_form', [
			'model' => $reqModel,
		]) ?>

		


		<section class="sectionMarg">
			<div class="cont">
				<div class="main_title">Наши партнеры</div>
				
				
				<?
				echo ListView::widget([
				    'dataProvider' => $banksProvider,
				    'itemView' => '_banks',
				    'layout' => '{items}',
				    'id'           => false,
				    'options' => [
					    'tag'=>'div',
					    'class' => 'slider_partners owl-carousel'
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
		</section>


		<section class="section_reviews sectionMarg">
			<div class="cont">
				<div class="main_title white">Отзывы наших клиентов</div>
				
				
				<?
					echo ListView::widget([
						'dataProvider' => $reviewsProvider,
						'itemView' => '_reviews',
						'layout' => '{items}',
						'id'           => false,
						'options' => [
							'tag'=>'div',
							'class' => 'slider_reviews owl-carousel'
						],
						'itemOptions' => [
						'tag' => false,
						],
						'viewParams' => [
						'fullView' => false,
						'context' => '',
						],
					]);
					?>
				
				
			</div>
		</section>	

		<section class="sectionMarg">
			<div class="cont">
				<div class="main_title">Последние статьи</div>
					
					<?
					echo ListView::widget([
						'dataProvider' => $articlesProvider,
						'itemView' => '_articles',
						'layout' => '{items}',
						'id'           => false,
						'itemOptions' => [
						'tag' => false,
						],
						'options' => [
							'tag'=>'div',
							'class' => 'slider_articles owl-carousel'
						],
						'viewParams' => [
						'fullView' => false,
						'context' => 'main-page',
						// ...
						],
					]);
					?>
			</div>
		</section>
	