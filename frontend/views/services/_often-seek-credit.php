<?php

use yii\helpers\Html;
use backend\models\CreditFilter;



?>
<br>
<hr>
<div class="often-seek-credit sectionMarg">
    <div class="container">
        <h2 align="center"><b>Часто ищут</b></h2>
        <div class="row">
            <br>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>Популярное</b></h4>
                <?php foreach ($credit_filter as $arr){
                    if ($arr['category'] == 0) {
                        echo Html::a($arr['url_name'], ['credit', 'code' => $arr['code']], ['class' => 'profile-link']);
                    }
                } ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>Рекомендованное</b></h4>
                <?php foreach ($credit_filter as $arr){
                    if ($arr['category'] == 1) {
                        echo Html::a($arr['url_name'], ['credit', 'code' => $arr['code']], ['class' => 'profile-link']);
                    }
                } ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>Популярные суммы</b></h4>
                <?php foreach ($credit_filter as $arr){
                    if ($arr['category'] == 2) {
                        echo Html::a($arr['url_name'], ['credit', 'code' => $arr['code']], ['class' => 'profile-link']);
                    }
                } ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>По сроку</b></h4>
                <?php foreach ($credit_filter as $arr){
                    if ($arr['category'] == 3) {
                        echo Html::a($arr['url_name'], ['credit', 'code' => $arr['code']], ['class' => 'profile-link']);
                    }
                } ?>
            </div>
        </div>
    </div>
</div>
