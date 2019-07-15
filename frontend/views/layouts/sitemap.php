<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <style id="xml-viewer-style">/* Copyright 2014 The Chromium Authors. All rights reserved.
 * Use of this source code is governed by a BSD-style license that can be
 * found in the LICENSE file.
 */

        div.header {
            border-bottom: 2px solid black;
            padding-bottom: 5px;
            margin: 10px;
        }

        div.collapsible gt; div.hidden {
                                display:none;
                            }

        .pretty-print {
            margin-top: 1em;
            margin-left: 20px;
            font-family: monospace;
            font-size: 13px;
        }

        #webkit-xml-viewer-source-xml {
            display: none;
        }

        .collapsible-content {
            margin-left: 1em;
        }
        .comment {
            white-space: pre;
        }

        .button {
            -webkit-user-select: none;
            cursor: pointer;
            display: inline-block;
            margin-left: -10px;
            width: 10px;
            background-repeat: no-repeat;
            background-position: left top;
            vertical-align: bottom;
        }

        .collapse-button {
            background: url("data:image/svg+xml,&lt;svg xmlns='http://www.w3.org/2000/svg' fill='%23909090' width='10' height='10'&gt;&lt;path d='M0 0 L8 0 L4 7 Z'/&gt;&lt;/svg&gt;");
            height: 10px;
        }

        .expand-button {
            background: url("data:image/svg+xml,&lt;svg xmlns='http://www.w3.org/2000/svg' fill='%23909090' width='10' height='10'&gt;&lt;path d='M0 0 L0 8 L7 4 Z'/&gt;&lt;/svg&gt;");
            height: 10px;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
