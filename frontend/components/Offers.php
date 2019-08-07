<?php

namespace frontend\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Request;

class Offers extends Widget {

    public $service_id;
    public $offersProvider;
    public $filter;
    public function init()
    {   
        parent::init();
    }

    public function run()
    {   
        
		return $this->render('offer_table_' . $this -> service_id , [
			'offersProvider' => $this -> offersProvider,
			'service_id' => $this -> service_id,
            'filter' => $this -> filter
		]);
    }
}
?>