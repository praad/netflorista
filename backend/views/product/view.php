<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'price',
            [
                'attribute' => 'types',
                'value' => function ($model) {
                    return join(', ', yii\helpers\ArrayHelper::map($model->types, 'id', 'title'));
                },
             ],
             [
                'attribute' => 'images',
                'value' => function ($model) {
                    return join(', ', yii\helpers\ArrayHelper::map($model->images, 'id', 'url'));
                },
             ],
            'availability',
        ],
    ]); ?>


    <h2><?= Yii::t('app', 'Product images'); ?></h2>

    <?php
    $images = yii\helpers\ArrayHelper::map($model->images, 'id', 'url');
    foreach ($images as $image) {
        echo Html::img(\Yii::$app->urlManagerFrontEnd->baseUrl.$image, ['width' => '100', 'height' => '100']);
    }
    ?>

</div>
