<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
?>	


		<section class="sectionMarg">
			<div class="cont">

				<div class="main_title">Подбор кредитов</div>

                <div class="credit_filter form">
                    <div class="credit_filter_col double_input">
                        <span>Сумма кредита</span>
                        <input id="filter-offer-price" type="text" name="" value="" placeholder="Любая" class="input summa">
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
                        <a onclick="filterOffer(); gotoform();" href="#table_profitably">Подобрать</a>
                    </div>
                </div>

				<div class="table_profitably">


					<div class="item_head">
						<div class="box small">Банк и название продукта</div>

						<div class="box small">Ставка</div>
                        <div class="box small">Сумма кредита</div>
						<div class="box small">Срок</div>

						<div class="box ">Преимущества</div>
					</div>

						<?
						echo ListView::widget([
							'dataProvider' => $offersProvider,
							'itemView'     => function ($model, $key, $index, $widget) {
								return $this->render('_offers_1', ['model' => $model, 'index' => $index+1]);
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
<?php var_dump($offersProvider); ?>