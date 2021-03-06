<?php

use yii\helpers\Html;
use backend\models\Files;

$model['rate'] /= 100;
?>


					

					

						<div data-element="true" <?if ( $model->link ):?>class="item offer_link"  href="<?=$model->link?>"<?else:?> class="item modal_link"  href="#modal_call"<?endif;?>>

								<div  class="box small">

									<div class="block">

										<div class="number"><?=$index?></div>

										

										<div class="ic_bank">
											
											<?if ( $model->banks->image ):?>
												<img src="<?=Files::getPath($model->banks->image)?>" alt="<?=$model['name']?>">
											<?endif;?>
											<?=$model['name']?>

										</div>

										

									</div>

								</div>





								<div class="box small">

									<div class="block">

										<div class="rate">от <?=$model['rate']?> % годовых</div>

									</div>

								</div>


                                <div class="box small" >

                                    <div class="block">

                                    	<div class="kredit_summ">
											
											<?if ( $model['min_summ_ipoteka'] ):?>
												<div> от <?=$model['min_summ_ipoteka']?> </div>
											<?endif;?>
											<?if ( $model['max_summ_ipoteka'] ):?>
												<div> до <?=$model['max_summ_ipoteka']?> </div>
											<?endif;?>
											
	                                    </div>

                                    </div>

                                </div>

                                <div class="box small" >

                                    <div class="block">

                                    	<div class="">

	                                        <div class="rate"><?=$model['initial_payment']?>%</div>

	
	                                    </div>

                                    </div>

                                </div>



								<div class="box ">

									<div class="block">

										 <?=$model['preview_text']?>	

									</div>

								</div>

						</div>