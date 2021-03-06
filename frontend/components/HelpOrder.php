<?php

namespace frontend\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Request;
use backend\models\Mailer;
use common\models\CuiteCrm;

class HelpOrder extends Widget {

    public function init()
    {   
        parent::init();
    }

    public function run()
    {   
		
		$reqModel = new Request();
		
		if ($reqModel->load(Yii::$app->request->post())) {
			if ( $reqModel->type == 'callbackForm' ){	
				if ( $reqModel->save()){

				}
				else {
					Yii::$app->session->setFlash('requestPopupFormFalse', 'Y');
				}
			}
		}
		
		
		return $this->render('help_form', [
		  'model' => $reqModel,
		]);
    }
}
?>