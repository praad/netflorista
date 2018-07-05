<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

/**
 * Product Controller API.
 */
class ProductController extends ActiveController
{
    public $modelClass = 'common\models\Product';
}
