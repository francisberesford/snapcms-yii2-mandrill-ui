<?php

namespace snapcms\mandrill\ui\controllers;

use Yii;
use snapcms\components\SnapCMSController;
use yii\web\NotFoundHttpException;

class DefaultController extends SnapCMSController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
