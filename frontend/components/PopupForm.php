<?php

namespace frontend\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Request;
use backend\models\Mailer;
use common\models\CuiteCrm;

class PopupForm extends Widget {

    public function init()
    {   
        parent::init();
    }

    public function run()
    {   
		
		$reqModel = new Request();
		$crmModel = new CuiteCrm;
		if ($reqModel->load(Yii::$app->request->post())) {
			if ( $reqModel->type == 'callbackForm' ){	
				if ( $reqModel->save()){
					Yii::$app->session->setFlash('requestPopupFormSubmitted', 'Y');
					$crmModel = new CuiteCrm;
					$crmModel -> ShortRequest( $reqModel );
					Mailer::sendCallbackMessage( 'Заявка с сайта (обратная связь) ', $reqModel );
				}
				else {
					Yii::$app->session->setFlash('requestPopupFormFalse', 'Y');
				}
			}
		}
		
		
		return $this->render('popup_form', [
		  'model' => $reqModel,
		]);
    }
}
?>