<?php
/**
 * Created by PhpStorm.
 * User: serg
 * Date: 27.06.2019
 * Time: 15:09
 */

namespace frontend\components;

use yii;
use yii\helpers\Html;
use yii\base\Model;
use backend\models\City;
use frontend\components\CurrentCity;

class ShortTag extends Model
{
    public static function cityTag($a)
    {
        $city = CurrentCity::currentCity();

        $a = str_replace('{city}', $city['name'], $a);
        $a = str_replace('{city-gde}', $city['dec1'], $a);
        $a = str_replace('{city-kuda}', $city['dec2'], $a);
        $a = str_replace('{city-v}', $city['dec3'], $a);
        $a = str_replace('{city-chego}', $city['dec4'], $a);
        
        return $a;
    }

}