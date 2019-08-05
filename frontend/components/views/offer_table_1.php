<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use backend\models\Offers;
use backend\models\Banks;
use backend\models\CreditFilter;

$banks = Banks::find()->select(['id', 'name'])->all();
$rates = Offers::find()->select(['id', 'rate'])->where(['service_id' => 1])->groupBy(['rate'])->all();

$controller = Yii::$app->controller->id;

$filter_bank = 'Все';
$filter_bank_value = '';
$filter_rate = 'Любая';
$filter_rate_value = '';
$filter_price = '';
$filter_date = 'На любой';
$filter_date_value = '';
$filter_age = '';
$filter_sort = 'Любой';

if ($controller == 'credit') {
    if ($filter['bank_id'] != 0) {
        $filter_bank_value = $filter['bank_id'];
        $filter_bank = Banks::find()->where(['id' => $filter_bank_value])->one();
        $filter_bank = $filter_bank['name'];

    }
    if ($filter['rate'] != null) {
        $filter_rate = $filter['rate'];
        $filter_rate_value = $filter_rate;
    }
    if ($filter['summ'] != null) {
        $filter_price = $filter['summ'];
    }
    if ($filter['term'] != null) {
        $filter_date = $filter['term'];
        $filter_date_value = $filter_date;
    }
}

?>	


		<section class="sectionMarg">
			<div class="cont">

				<div class="main_title">Подбор кредитов</div>

                <div class="credit_filter form">
                    <div class="credit_filter_col">
                        <span>Банк</span>
                        <div class="selectWrap">
                            <select name="" style="display: none;">
                                <option value="">Все</option>
                                <?php foreach ($banks as $bank) { ?>
                                    <option value="<?= $bank['name'] ?>"><?= $bank['name'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="nice-select" tabindex="0"><span class="current"><?= $filter_bank ?></span>
                                <ul id="filter-offer-bank" class="list">
                                    <li data-value="<?= $filter_bank_value ?>" class="option selected"><?= $filter_bank ?></li>
                                    <li data-value="" class="option" >Все</li>
                                    <?php foreach ($banks as $bank) { ?>
                                        <li data-value="<?= $bank['name'] ?>" class="option"><?= $bank['name'] ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="credit_filter_col">
                        <span>Ставка</span>
                        <div class="selectWrap">
                            <select name="" style="display: none;">
                                <option value="">Любая</option>
                                <?php foreach ($rates as $rate) { ?>
                                    <option value="<?= $rate['rate'] ?>">от <?= $rate['rate'] ?> % годовых</option>
                                <?php } ?>
                            </select>
                            <div class="nice-select" tabindex="0"><span class="current"><?= $filter_rate ?></span>
                                <ul id="filter-offer-rate" class="list">
                                    <li data-value="<?= $filter_rate_value ?>" class="option selected" ><?= $filter_rate ?></li>
                                    <li data-value="" class="option" >Любая</li>
                                    <?php foreach ($rates as $rate) { ?>
                                        <li data-value="<?= $rate['rate'] ?>" class="option">от <?= $rate['rate'] ?> % годовых</li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="credit_filter_col double_input">
                        <span>Сумма кредита</span>
                        <input id="filter-offer-price" type="text" name="" value="<?= $filter_price ?>" placeholder="Любая" class="input summa">
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
                            <div class="nice-select" tabindex="0"><span class="current"><?= $filter_date ?></span>
                                <ul id="filter-offer-date" class="list">
                                    <li data-value="" class="option selected" ><?= $filter_date ?></li>
                                    <li data-value="" class="option" >На любой</li>
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
                        <span>Возраст заемщика</span>
                        <input id="filter-offer-age" type="text" name="age" value="<?= $filter_age ?>" placeholder="Любой" class="input summa">
                    </div>

                    <div class="credit_filter_col">
                        <span>Приоритет</span>

                        <div class="selectWrap">
                            <select name="" style="display: none;">
                                <option value="">На любой</option>
                                <option value="1">1 месяц</option>
                                <option value="3">3 месяца</option>
                                <option value="6">6 месяцев</option>
                            </select>
                            <div class="nice-select" tabindex="0"><span class="current"><?= $filter_sort ?></span>
                                <ul id="filter-offer-sort" class="list">
                                    <li data-value="" class="option selected" ><?= $filter_sort ?></li>
                                    <li data-value="" class="option" >Любой</li>
                                    <li data-value="0" class="option">Низкий</li>
                                    <li data-value="1" class="option">Средний</li>
                                    <li data-value="2" class="option">Высокий</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="credit_filter_col">
                        <a onclick="filterOffer(); gotoform();" href="#table_profitably">Подобрать</a>
                    </div>
                </div>

                <?php if ($controller == 'credit') {
                    $this->registerJs(<<<JS
                    
                    filterOffer(); gotoform();
                    
JS
                        , \yii\web\View::POS_READY);
                } ?>


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
