<?php

use yii\helpers\Html;


?>
<br><br>
<hr>
<div class="often-seek-credit sectionMarg">
    <div class="container">
        <h2 align="center"><b>Часто ищут</b></h2>
        <div class="row">
            <br>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>Популярное</b></h4>
                <?php foreach ($often_seek as $arr){
                    if ($arr['category'] == 0) { ?>
                        <a href="/credit/<?=$arr['code'] ?>">
                            <?=$arr['url_name'] ?>
                        </a><br>
                    <?php }
                } ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>Рекомендованное</b></h4>
                <?php foreach ($often_seek as $arr){
                    if ($arr['category'] == 1) { ?>
                        <a href="/credit/<?=$arr['code'] ?>">
                            <?=$arr['url_name'] ?>
						</a><br>
                    <?php }
                } ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>Популярные суммы</b></h4>
                <?php foreach ($often_seek as $arr){
                    if ($arr['category'] == 2) { ?>
                        <a href="/credit/<?=$arr['code'] ?>">
                            <?=$arr['url_name'] ?>
                        </a><br>
                    <?php }
                } ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <h4><b>По сроку</b></h4>
                <?php foreach ($often_seek as $arr){
                    if ($arr['category'] == 3) { ?>
                        <a href="/credit/<?=$arr['code'] ?>">
                            <?=$arr['url_name'] ?>
                        </a><br>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
