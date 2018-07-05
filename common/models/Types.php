<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "types".
 *
 * @property int             $id
 * @property string          $title
 * @property ProductsTypes[] $productsTypes
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasMany(ProductType::className(), ['type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     *
     * @return TypeQuery the active query used by this AR class
     */
    public static function find()
    {
        return new TypeQuery(get_called_class());
    }
}