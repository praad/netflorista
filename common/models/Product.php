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
 * @property ProductImage[] $productsImage
 * @property ProductType[]  $productsType
 */
class Product extends \yii\db\ActiveRecord
{
    //public $types;

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
            //[['types'], 'exist', 'targetClass' => '\app\models\Type'],
            //[['images'], 'exist', 'targetClass' => '\app\models\Image'],
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
            'types' => Yii::t('app', 'Types'),
            'images' => Yii::t('app', 'Images'),
            'availability' => Yii::t('app', 'Availability'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])
            ->viaTable('products_images', ['product_id' => 'id'])
            ->with(['products']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['id' => 'type_id'])
            ->viaTable('products_types', ['product_id' => 'id']);
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

    public function fields()
    {
        return ['id', 'title', 'price', 'types', 'images', 'availability'];
    }
}
