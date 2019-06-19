<?php

namespace backend\controllers;


use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use backend\models\UploadForm;

class TestController extends Controller
{
   public function actionIndex()
   {
      $model = new UploadForm();

      return $this->render('index', ['model'=>$model]);  
   }
}