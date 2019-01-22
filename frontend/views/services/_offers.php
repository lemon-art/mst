<?php

use yii\helpers\Html;

use backend\models\Files;

?>





					

					

						<div data-element="true" data-min-term="<?=$model['min_term']?>" data-max-term="<?=$model['max_term']?>" data-max-price="<?=$model['max_summ']?>" data-min-price="<?=$model['min_summ']?>"  class="item modal_link" href="#modal_call">

								<div  class="box <?if ( $model->service_id == 1){?>small<?}?>">

									<div class="block">

										<div class="number"><?=$index?></div>

										

										<div class="ic_bank">

											<img src="<?=Files::getPath($model->banks->image)?>" alt="<?=$model['name']?>">

											<?=$model['name']?>

										</div>

										

									</div>

								</div>





								<div class="box  <?if ( $model->service_id == 1){?>small<?}?>">

									<div class="block">

										<div class="rate">от <?=$model['rate']?> % годовых</div>

									</div>

								</div>

                            <?if ( $model->service_id == 1){?>

                                <div class="box small" >

                                    <div class="block">

                                    	<div class="kredit_summ">

	                                        <div> от <?=$model['min_summ']?> </div>

	                                        <div> до <?=$model['max_summ']?> </div>

	                                    </div>

                                    </div>

                                </div>

                            <?}?>

								<div class="box  <?if ( $model->service_id == 1){?>small<?}?>">

									<div class="block">

										<div class="time">от <?=$model['min_term']?> до <?=$model['max_term']?> месяцев</div>

									</div>

								</div>



								<div class="box ">

									<div class="block">

										 <?=$model['preview_text']?>	

									</div>

								</div>

						</div>