<?php

use yii\helpers\Html;
use backend\models\CreditFilter;



?>
<h2>Часто ищут</h2>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <h3>Популярное</h3>
            <?php foreach ($credit_filter as $arr){
                if ($arr['category'] = 0) {
                    echo $arr['url_name'];
                }
            } ?>
        </div>
        <div class="col-sm-3">
            <h3>Рекомендованное</h3>
            <?php foreach ($credit_filter as $arr){
                if ($arr['category'] = 1) {
                    echo $arr['url_name'];
                }
            } ?>
        </div>
        <div class="col-sm-3">
            <h3>Популярные суммы</h3>
            <?php foreach ($credit_filter as $arr){
                if ($arr['category'] = 2) {
                    echo $arr['url_name'];
                }
            } ?>
        </div>
        <div class="col-sm-3">
            <h3>По сроку</h3>
            <?php foreach ($credit_filter as $arr){
                if ($arr['category'] = 3) {
                    echo $arr['url_name'];
                }
            } ?>
        </div>
    </div>
</div>
