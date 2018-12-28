<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use frontend\components\OrderForm;
use frontend\components\DebetForm;
/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

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

		<section class="sectionMarg">
			<div class="cont">
                <?if ( $model->id == 1):?>
				<div class="main_title">Подбор кредитов</div>

                <div class="credit_filter form">
                    <div class="credit_filter_col double_input">
                        <span>Сумма кредита</span>
                        <input id="filter-offer-price" type="text" name="" value="" placeholder="Любая" class="input">
                        <div class="selectWrap">
                            <select name="" style="display: none;">
								<option value=""></option>
                                <option value="">₽</option>
                                <option value="">$</option>
                                <option value="">€</option>
                            </select><div class="nice-select" tabindex="0"><span class="current">₽</span><ul class="list"><li data-value="" class="option"></li><li data-value="" class="option selected">₽</li><li data-value="" class="option">$</li><li data-value="" class="option">€</li></ul></div>
                        </div>
                    </div>
                    <div class="credit_filter_col">
                        <span>На какой срок</span>

                        <div class="selectWrap">
                            <select name="" style="display: none;">
                                <option value="">На любой</option>
                                <option value="1">1 месяц</option>
                                <option value="3">3 месяца</option>
                                <option value="6">6 месяцев</option>
                                <option value="9">9 месяцев</option>
                                <option value="12">1 год</option>
                                <option value="24">2 года</option>
                                <option value="36">3 года</option>
                                <option value="48">4 года</option>
                                <option value="60">5 лет</option>
                            </select>
                            <div class="nice-select" tabindex="0"><span class="current">На любой</span>
                                <ul id="filter-offer-date" class="list">
                                    <li data-value="" class="option selected" >На любой</li>
                                    <li data-value="1" class="option">1 месяц</li>
                                    <li data-value="3" class="option">3 месяца</li>
                                    <li data-value="6" class="option">6 месяцев</li>
                                    <li data-value="9" class="option">9 месяцев</li>
                                    <li data-value="12" class="option">1 год</li>
                                    <li data-value="24" class="option">2 года</li>
                                    <li data-value="36" class="option">3 года</li>
                                    <li data-value="48" class="option">4 года</li>
                                    <li data-value="60" class="option">5 лет</li>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="credit_filter_col">
                        <a onclick="filterOffer();">Подобрать</a>
                    </div>
                </div>
                <?else:?>
                    <div class="main_title">Выгодное предложение</div>
                <?endif;?>
				<div class="table_profitably">
					<div class="item_head">
						<div class="box small"><span>№</span> Банк</div>

						<div class="box small">Ставка</div>
                        <?if ( $model->id == 1):?><div class="box small">Сумма кредита</div><?endif;?>
						<div class="box small">Срок</div>

						<div class="box ">Преимущества</div>
					</div>


						<?
						echo ListView::widget([
							'dataProvider' => $offersProvider,
							'itemView'     => function ($model, $key, $index, $widget) {
								return $this->render('_offers', ['model' => $model, 'index' => $index+1]);
							},
							'layout' => '{items}',
							'id'           => false,
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

		<?=OrderForm::widget(['service_id' => $model->id, 'service_name' => $model->short_name]);?>

		
		
	