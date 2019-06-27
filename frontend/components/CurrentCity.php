<?php
/**
 * Created by PhpStorm.
 * User: serg
 * Date: 27.06.2019
 * Time: 15:09
 */

namespace frontend\components;

use yii\base\Model;
use backend\models\City;

class Banks extends Model
{
    public static function currentCity()
    {
        //текущий город
        $subdomain = current(explode('.', $_SERVER['HTTP_HOST']));
        $city = '';
        if ($subdomain == 'dev' || $subdomain == 'marketvibor') {
            $city['dec1'] = 'в России';
        } else {
            $city = City::find()->where(['subdomain' => $subdomain])->one();
            $city = (array)$city;
            $city = current($city);
            if (!$city) {
                header('Location: http://marketvibor.ru'.Yii::$app->request->url);
                $city['dec1'] = 'в России';
            }
        }
        return $city;
    }

}