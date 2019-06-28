<?php
/**
 * Created by PhpStorm.
 * User: serg
 */

namespace frontend\components;

use yii;
use yii\helpers\Html;
use yii\base\Model;
use frontend\components\CurrentCity;

class ShortTag extends Model
{
    public static function cityTag($text)
    {
        $city = CurrentCity::currentCity();
        if (!$city) {
            header('Location: http://marketvibor.ru'.Yii::$app->request->url);
            $city['dec1'] = 'в России';
        } else {
            $text = str_replace(' {city}', $city['name'], $text);
            $text = str_replace(' {city-gde}', $city['dec1'], $text);
            $text = str_replace(' в России', '', $text);
            $text = str_replace(' {city-kuda}', $city['dec2'], $text);
            $text = str_replace(' {city-v}', $city['dec3'], $text);
            $text = str_replace(' {city-chego}', $city['dec4'], $text);
        }
        
        return $text;
    }

}