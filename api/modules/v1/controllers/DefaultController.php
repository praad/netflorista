<?php

namespace api\modules\v1\controllers;

use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        //throw new NotFoundHttpException('Unsuported action request', 100);
        throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
    }
}
