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

										<div class="rate"><?=$model['residue']?></div>

									</div>

								</div>


                                <div class="box small" >

                                    <div class="block">

                                    	<div class="kredit_summ">

	                                        <?=$model['cash_back']?>


	                                    </div>

                                    </div>

                                </div>


								<div class="box  small">

									<div class="block">

										<div class="kredit_summ"><?=$model['maintenance_cost']?></div>

									</div>

								</div>



								<div class="box ">

									<div class="block">

										 <?=$model['preview_text']?>	

									</div>

								</div>

						</div>