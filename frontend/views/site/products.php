<?php

use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form ActiveForm */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="products">

    <?= DetailView::widget([
        'model' => $product,
        'attributes' => [
            'id',
            'title',
            'price',
            [
                'attribute' => 'types',
                'value' => function ($product) {
                    return join(', ', yii\helpers\ArrayHelper::map($product->types, 'id', 'title'));
                },
             ],
             [
                'attribute' => 'images',
                'value' => function ($product) {
                    return join(', ', yii\helpers\ArrayHelper::map($product->images, 'id', 'url'));
                },
             ],
            'availability',
        ],
    ]); ?>


</div><!-- products -->