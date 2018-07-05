<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products_images`.
 * Has foreign keys to the tables:
 *
 * - `products`
 * - `images`
 */
class m180705_192432_create_products_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products_images', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'image_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-products_images-product_id',
            'products_images',
            'product_id'
        );

        // add foreign key for table `products`
        $this->addForeignKey(
            'fk-products_images-product_id',
            'products_images',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );

        // creates index for column `image_id`
        $this->createIndex(
            'idx-products_images-image_id',
            'products_images',
            'image_id'
        );

        // add foreign key for table `images`
        $this->addForeignKey(
            'fk-products_images-image_id',
            'products_images',
            'image_id',
            'images',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `products`
        $this->dropForeignKey(
            'fk-products_images-product_id',
            'products_images'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-products_images-product_id',
            'products_images'
        );

        // drops foreign key for table `images`
        $this->dropForeignKey(
            'fk-products_images-image_id',
            'products_images'
        );

        // drops index for column `image_id`
        $this->dropIndex(
            'idx-products_images-image_id',
            'products_images'
        );

        $this->dropTable('products_images');
    }
}
