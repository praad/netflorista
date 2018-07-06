<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int            $id
 * @property string         $url
 * @property ProductImage[] $productsImages
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->viaTable('products_images', ['id' => 'id']);
    }

    /**
     * {@inheritdoc}
     *
     * @return ImageQuery the active query used by this AR class
     */
    public static function find()
    {
        return new ImageQuery(get_called_class());
    }
}
