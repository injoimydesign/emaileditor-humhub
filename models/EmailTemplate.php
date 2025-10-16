<?php

namespace humhub\modules\emailtemplates\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * EmailTemplate Model
 *
 * @property int $id
 * @property string $template_key
 * @property string $subject
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 */
class EmailTemplate extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emailtemplate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_key', 'subject', 'body'], 'required'],
            [['body'], 'string'],
            [['template_key'], 'string', 'max' => 100],
            [['subject'], 'string', 'max' => 255],
            [['template_key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_key' => 'Template Key',
            'subject' => 'Email Subject',
            'body' => 'Email Body',
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
     * Load default template values
     * @param array $templateInfo
     */
    public function loadDefaults($templateInfo)
    {
        $this->subject = isset($templateInfo['default_subject']) ? $templateInfo['default_subject'] : $templateInfo['name'];
        $this->body = isset($templateInfo['default_body']) ? $templateInfo['default_body'] : $this->getDefaultBody($templateInfo);
    }

    /**
     * Get default body content
     * @param array $templateInfo
     * @return string
     */
    protected function getDefaultBody($templateInfo)
    {
        $placeholders = implode(', ', $templateInfo['placeholders']);
        return "Hi {displayName},\n\nThis is a notification from the system.\n\nAvailable placeholders: " . $placeholders . "\n\nBest regards,\nThe Team";
    }

    /**
     * Get preview with sample data
     * @return string
     */
    public function getPreview()
    {
        $sampleData = [
            '{displayName}' => 'John Doe',
            '{contentTitle}' => 'Sample Post Title',
            '{contentInfo}' => 'This is sample content',
            '{contentPreview}' => 'This is a preview of the content...',
            '{commentText}' => 'This is a sample comment',
            '{spaceName}' => 'Sample Space',
            '{spaceDescription}' => 'A collaborative space for team members',
            '{url}' => 'https://example.com/sample-link',
            '{siteName}' => 'My HumHub Site',
            '{author}' => 'Jane Smith',
            '{originator}' => 'Jane Smith',
            '{requester}' => 'Bob Johnson',
            '{email}' => 'john.doe@example.com',
            '{password}' => '********',
            '{follower}' => 'Jane Smith',
            '{message}' => 'We would love to have you join our community!'
        ];
        
        $previewSubject = $this->subject;
        $previewBody = $this->body;
        
        foreach ($sampleData as $placeholder => $value) {
            $previewSubject = str_replace($placeholder, '<strong>' . $value . '</strong>', $previewSubject);
            $previewBody = str_replace($placeholder, '<strong>' . $value . '</strong>', $previewBody);
        }
        
        return '<div style="margin-bottom: 15px;"><strong>Subject:</strong> ' . $previewSubject . '</div>' . nl2br($previewBody);
    }

    /**
     * Get template by key
     * @param string $key
     * @return EmailTemplate|null
     */
    public static function getByKey($key)
    {
        return static::findOne(['template_key' => $key]);
    }
}