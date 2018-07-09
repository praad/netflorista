<?php

use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\Html;

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
            'availability',
        ],
    ]); ?>
    
    
    <h2><?= Yii::t('app', 'Product images'); ?></h2>

    <?php
    $images = yii\helpers\ArrayHelper::map($product->images, 'id', 'url');
    foreach ($images as $image) {
        echo Html::img($image, ['width' => '100', 'height' => '100']);
        //echo Html::img(Yii::getAlias('@uploads').'/'.$image, ['width' => '100', 'height' => '100']);
    }
    ?>

</div><!-- products -->