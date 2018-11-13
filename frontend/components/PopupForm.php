<?php

namespace frontend\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Request;

class PopupForm extends Widget {

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
					Yii::$app->session->setFlash('requestPopupFormSubmitted');
				}
				else {
					Yii::$app->session->setFlash('requestPopupFormFalse');
				}
			}
		}
		
		
		return $this->render('popup_form', [
		  'model' => $reqModel,
		]);
    }
}
?>