<?php

use yii\db\Migration;

class m000000_000001_email_style extends Migration
{
    public function safeUp()
    {
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
    }

    public function safeDown()
    {
        $this->dropTable('emailstyle');
    }
}