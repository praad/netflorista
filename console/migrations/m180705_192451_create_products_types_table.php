<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products_types`.
 * Has foreign keys to the tables:
 *
 * - `products`
 * - `types`
 */
class m180705_192451_create_products_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products_types', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-products_types-product_id',
            'products_types',
            'product_id'
        );

        // add foreign key for table `products`
        $this->addForeignKey(
            'fk-products_types-product_id',
            'products_types',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );

        // creates index for column `type_id`
        $this->createIndex(
            'idx-products_types-type_id',
            'products_types',
            'type_id'
        );

        // add foreign key for table `types`
        $this->addForeignKey(
            'fk-products_types-type_id',
            'products_types',
            'type_id',
            'types',
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
            'fk-products_types-product_id',
            'products_types'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-products_types-product_id',
            'products_types'
        );

        // drops foreign key for table `types`
        $this->dropForeignKey(
            'fk-products_types-type_id',
            'products_types'
        );

        // drops index for column `type_id`
        $this->dropIndex(
            'idx-products_types-type_id',
            'products_types'
        );

        $this->dropTable('products_types');
    }
}
