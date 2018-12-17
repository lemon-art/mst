<?php
// YOUR_APP/views/list/_list_item.php
use backend\models\Files;
use yii\helpers\Html;
?>


					<tr>
						<td>
							<a href="<?=$model['orderUrl']?>"><?=$model['id'] ?></a>
						</td>
						<td>
							<a href="<?=$model['orderUrl']?>"><?=$model['date']?></a>
						</td>
						<td>
							<a href="<?=$model['orderUrl']?>">
								<?=$model['fullName'] ?>
							</a>
						</td>
						
						<td>
							<?=$model['services']['name'] ?>
						</td>
						<td>
							<span class="label <?=$model['statusCode'] ?>"><?=$model['statusName'] ?></span>
						</td>
					  </tr>