<?php

use yii\db\Migration;

class m000000_000000_initial extends Migration
{
    public function safeUp()
    {
        $this->createTable('emailtemplate', [
            'id' => $this->primaryKey(),
            'template_key' => $this->string(100)->notNull()->unique(),
            'subject' => $this->string(255)->notNull(),
            'body' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
        
        $this->createTable('emailstyle', [
            'id' => $this->primaryKey(),
            'header_html' => $this->text(),
            'footer_html' => $this->text(),
            'primary_color' => $this->string(7)->defaultValue('#3498db'),
            'background_color' => $this->string(7)->defaultValue('#f4f4f4'),
            'text_color' => $this->string(7)->defaultValue('#333333'),
            'link_color' => $this->string(7)->defaultValue('#3498db'),
            'button_color' => $this->string(7)->defaultValue('#3498db'),
            'button_text_color' => $this->string(7)->defaultValue('#ffffff'),
            'custom_css' => $this->text(),
            'logo_url' => $this->string(255),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->createIndex('idx_template_key', 'emailtemplate', 'template_key');
    }

    public function safeDown()
    {
        $this->dropTable('emailtemplate');
        $this->dropTable('emailstyle');
    }
}