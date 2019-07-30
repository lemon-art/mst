<?php

use yii\helpers\Html;
use backend\models\CreditFilter;



?>
<hr>
<div class="often-seek-credit">
    <div class="container">
        <br>
        <h2><b>Часто ищут</b></h2>
        <div class="row">


            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>Популярное</b></h4>
                <?php foreach ($credit_filter as $arr){
                    if ($arr['category'] == 0) {
                        echo $arr['url_name'];
                    }
                } ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>Рекомендованное</b></h4>
                <?php foreach ($credit_filter as $arr){
                    if ($arr['category'] == 1) {
                        echo $arr['url_name'];
                    }
                } ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>Популярные суммы</b></h4>
                <?php foreach ($credit_filter as $arr){
                    if ($arr['category'] == 2) {
                        echo $arr['url_name'];
                    }
                } ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>По сроку</b></h4>
                <?php foreach ($credit_filter as $arr){
                    if ($arr['category'] == 3) {
                        echo $arr['url_name'];
                    }
                } ?>
            </div>
        </div>
        <br>
    </div>
</div>
