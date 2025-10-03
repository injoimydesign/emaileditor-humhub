<?php

namespace humhub\modules\emailtemplates\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * EmailStyle Model
 *
 * @property int $id
 * @property string $header_html
 * @property string $footer_html
 * @property string $primary_color
 * @property string $background_color
 * @property string $text_color
 * @property string $link_color
 * @property string $button_color
 * @property string $button_text_color
 * @property string $custom_css
 * @property string $logo_url
 * @property string $created_at
 * @property string $updated_at
 */
class EmailStyle extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emailstyle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['header_html', 'footer_html', 'custom_css'], 'string'],
            [['primary_color', 'background_color', 'text_color', 'link_color', 'button_color', 'button_text_color'], 'string', 'max' => 7],
            [['logo_url'], 'string', 'max' => 255],
            [['primary_color', 'background_color', 'text_color', 'link_color', 'button_color', 'button_text_color'], 'match', 'pattern' => '/^#[0-9A-Fa-f]{6}$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header_html' => 'Email Header HTML',
            'footer_html' => 'Email Footer HTML',
            'primary_color' => 'Primary Color',
            'background_color' => 'Background Color',
            'text_color' => 'Text Color',
            'link_color' => 'Link Color',
            'button_color' => 'Button Color',
            'button_text_color' => 'Button Text Color',
            'custom_css' => 'Custom CSS',
            'logo_url' => 'Logo URL',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * Get the active email style configuration
     * @return EmailStyle
     */
    public static function getActive()
    {
        $style = static::find()->orderBy(['id' => SORT_DESC])->one();
        
        if (!$style) {
            $style = new static();
            $style->loadDefaults();
        }
        
        return $style;
    }

    /**
     * Load default style values
     */
    public function loadDefaults()
    {
        $this->primary_color = '#3498db';
        $this->background_color = '#f4f4f4';
        $this->text_color = '#333333';
        $this->link_color = '#3498db';
        $this->button_color = '#3498db';
        $this->button_text_color = '#ffffff';
        
        $this->header_html = '<div style="text-align: center; padding: 20px;">
    <img src="{logo_url}" alt="Logo" style="max-width: 200px; height: auto;">
</div>';
        
        $this->footer_html = '<div style="text-align: center; padding: 20px; font-size: 12px; color: #999;">
    <p>&copy; ' . date('Y') . ' {siteName}. All rights reserved.</p>
    <p>
        <a href="{unsubscribe_url}" style="color: #999;">Unsubscribe</a> | 
        <a href="{settings_url}" style="color: #999;">Email Settings</a>
    </p>
</div>';
        
        $this->custom_css = '/* Custom CSS styles for email templates */
.email-container {
    max-width: 600px;
    margin: 0 auto;
    font-family: Arial, sans-serif;
}

.email-button {
    display: inline-block;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 4px;
}';
        
        $this->logo_url = '';
    }

    /**
     * Get rendered header HTML
     * @return string
     */
    public function getRenderedHeader()
    {
        return $this->replaceVariables($this->header_html);
    }

    /**
     * Get rendered footer HTML
     * @return string
     */
    public function getRenderedFooter()
    {
        return $this->replaceVariables($this->footer_html);
    }

    /**
     * Replace variables in HTML
     * @param string $html
     * @return string
     */
    protected function replaceVariables($html)
    {
        $variables = [
            '{logo_url}' => $this->logo_url ?: 'https://via.placeholder.com/200x60?text=Logo',
            '{siteName}' => Yii::$app->name,
            '{unsubscribe_url}' => '#',
            '{settings_url}' => '#',
        ];
        
        return str_replace(array_keys($variables), array_values($variables), $html);
    }

    /**
     * Get full CSS including colors
     * @return string
     */
    public function getFullCss()
    {
        $css = "
/* Email Color Scheme */
:root {
    --primary-color: {$this->primary_color};
    --background-color: {$this->background_color};
    --text-color: {$this->text_color};
    --link-color: {$this->link_color};
    --button-color: {$this->button_color};
    --button-text-color: {$this->button_text_color};
}

body {
    background-color: {$this->background_color};
    color: {$this->text_color};
}

a {
    color: {$this->link_color};
}

.email-button {
    background-color: {$this->button_color};
    color: {$this->button_text_color};
}

";
        
        return $css . "\n" . $this->custom_css;
    }

    /**
     * Generate preview HTML
     * @return string
     */
    public function getPreviewHtml()
    {
        return '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        ' . $this->getFullCss() . '
    </style>
</head>
<body>
    <div class="email-container">
        ' . $this->getRenderedHeader() . '
        
        <div style="background: white; padding: 30px; margin: 20px 0;">
            <h2>Email Preview</h2>
            <p>This is how your emails will look with the current styling.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
               <a href="#">This is a sample link</a> within the email content.</p>
            <p style="text-align: center; margin: 30px 0;">
                <a href="#" class="email-button">Sample Button</a>
            </p>
        </div>
        
        ' . $this->getRenderedFooter() . '
    </div>
</body>
</html>';
    }
}