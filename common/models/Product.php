<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int            $id
 * @property string         $title
 * @property string         $price
 * @property int            $availability
 * @property ProductImage[] $productsImages
 * @property ProductType[]  $productsTypes
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'price'], 'required'],
            [['price'], 'number'],
            [['availability'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'price' => Yii::t('app', 'Price'),
            'availability' => Yii::t('app', 'Availability'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImage()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasMany(ProductType::className(), ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     *
     * @return ProductQuery the active query used by this AR class
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
