<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace frontend\components;

use dektrium\user\models\RegistrationForm;
use yii\base\Widget;

/**
 * Register for widget.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Register extends Widget
{
    /**
     * @var bool
     */
    public $validate = true;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('register', [
            'model' => \Yii::createObject(RegistrationForm::className()),
        ]);
    }
}
