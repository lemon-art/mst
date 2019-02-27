<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use backend\models\Files;
use frontend\components\OrderForm;
use frontend\components\DebetForm;
use frontend\components\Offers;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = $model->title;
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->params['breadcrumbs'][] = $model->name;
?>

			<section class="section_first">
				<div class="cont">
					<?=
					Breadcrumbs::widget(
						[
							'homeLink' => ['label' => 'Главная', 'url' => '/'],
							'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
							'tag' => 'div',
							'options' => [
								'class' => 'breadcrumbs',//этот класс стоит по умолчанию
								'style' => '',
								'itemscope' => '',
								'itemtype' => 'http://schema.org/BreadcrumbList'
							],
							'itemTemplate' => '<span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">{link}</span> <span class="step"></span>',
							'activeItemTemplate' => "{link}",
						]
					) ?>

					<div class="title_inner"><?= Html::encode($model->name) ?></div>			



					<div class="info"><?= Html::encode($model->top_text) ?></div>

					<div class="completed">
						<a href="#completed" class="scroll_link">Заполнить заявку</a>
					</div>
				</div>
			</section>


		<section class="sectionMarg">
			<div class="cont">
				<div class="main_title">Наши преимущества</div>

				<?=$model->advantages?>
			</div>
		</section>


		<section class="scheme_work sectionMarg">
			<div class="cont">
				<div class="main_title">Схема работы</div>
				
				<?=$model->scheme?>
			</div>
		</section>

        <section>

        </section>

		
		
		<?=Offers::widget(['service_id' => $model->id, 'offersProvider' => $offersProvider]);?>

		<?=OrderForm::widget(['service_id' => $model->id, 'service_name' => $model->short_name]);?>

		<?if ( $model->seo_text ):?>
			<section class="sectionMarg">
				<div class="cont seo_text">
					<?=$model->seo_text_preview?>
					
					<?if ( $model->seo_text_detail ):?>
						<a href="#" class="show_more">Читать далее</a>
						<div class="more_info" style="display:none;">
							<?=$model->seo_text_detail?>
						</div>
					<?endif;?>
					
				</div>
			</section>		
		<?endif;?>

<?if ( $model->big_image ):?>		
<?$imgFon = Files::getPath($model->big_image);?>
<?
$script = <<< JS
    jQuery('.section_first').css({ 'background': 'url($imgFon) 0 0 no-repeat' });
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>	
<?endif;?>
	