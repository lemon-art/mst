<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class UploadForm extends Model
{
 
 public $file;
 
 public function rules()
 {
 return [
 // username and password are both required
 
 [['file'], 'file', 'extensions' => 'png, jpg', 
                    'skipOnEmpty' => false]];
 }

}