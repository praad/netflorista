<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'types', ['template' => '{label}{input}<a href="'.Url::toRoute('type/create').'">'.yii::t('app', 'Create new type').'</a>'])->dropDownList(
            ArrayHelper::map($types, 'id', 'title'),
            array('multiple' => true, 'selected' => 'selected'));
    ?>

    <?= $form->field($model, 'availability')->checkBox(['label' => yii::t('app', 'This product is available'), 'uncheck' => 0, 'checked' => 1]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
