<?php

namespace humhub\modules\emailtemplates;

use Yii;
use yii\helpers\Url;

class Module extends \humhub\components\Module
{
    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/emailtemplates/admin/index']);
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        // Clean up any custom templates on disable if needed
        parent::disable();
    }

    /**
     * Get list of available email templates
     * @return array
     */
    public static function getAvailableTemplates()
    {
        return [
            'notification' => [
                'name' => 'General Notification',
                'path' => '@humhub/modules/notification/views/emails/NotificationEmail.php',
                'placeholders' => ['{displayName}', '{contentTitle}', '{contentInfo}', '{url}', '{siteName}'],
                'default_subject' => 'New notification on {siteName}',
                'default_body' => "Hi {displayName},\n\nYou have a new notification:\n\n{contentTitle}\n{contentInfo}\n\nView it here: {url}\n\nBest regards,\n{siteName} Team"
            ],
            'new_comment' => [
                'name' => 'New Comment Notification',
                'path' => '@humhub/modules/comment/views/emails/NewComment.php',
                'placeholders' => ['{displayName}', '{contentTitle}', '{commentText}', '{url}', '{siteName}', '{author}'],
                'default_subject' => '{author} commented on {contentTitle}',
                'default_body' => "Hi {displayName},\n\n{author} commented on: {contentTitle}\n\nComment:\n{commentText}\n\nView and reply: {url}\n\nBest regards,\n{siteName} Team"
            ],
            'new_like' => [
                'name' => 'New Like Notification',
                'path' => '@humhub/modules/like/views/emails/NewLike.php',
                'placeholders' => ['{displayName}', '{contentTitle}', '{url}', '{siteName}', '{author}'],
                'default_subject' => '{author} likes your post',
                'default_body' => "Hi {displayName},\n\n{author} likes your post: {contentTitle}\n\nView it here: {url}\n\nBest regards,\n{siteName} Team"
            ],
            'space_invite' => [
                'name' => 'Space Invitation',
                'path' => '@humhub/modules/space/views/emails/Invite.php',
                'placeholders' => ['{displayName}', '{spaceName}', '{url}', '{siteName}', '{originator}', '{spaceDescription}'],
                'default_subject' => 'You have been invited to join {spaceName}',
                'default_body' => "Hi {displayName},\n\n{originator} has invited you to join the space: {spaceName}\n\n{spaceDescription}\n\nAccept invitation: {url}\n\nBest regards,\n{siteName} Team"
            ],
            'user_invite' => [
                'name' => 'User Invitation',
                'path' => '@humhub/modules/user/views/emails/Invite.php',
                'placeholders' => ['{displayName}', '{url}', '{siteName}', '{originator}', '{message}'],
                'default_subject' => 'Join {siteName}',
                'default_body' => "Hi {displayName},\n\n{originator} has invited you to join {siteName}.\n\n{message}\n\nClick here to register: {url}\n\nBest regards,\n{siteName} Team"
            ],
            'password_recovery' => [
                'name' => 'Password Recovery',
                'path' => '@humhub/modules/user/views/emails/RecoverPassword.php',
                'placeholders' => ['{displayName}', '{url}', '{siteName}'],
                'default_subject' => 'Password recovery for {siteName}',
                'default_body' => "Hi {displayName},\n\nYou have requested to reset your password.\n\nClick the link below to create a new password:\n{url}\n\nIf you did not request this, please ignore this email.\n\nBest regards,\n{siteName} Team"
            ],
            'welcome' => [
                'name' => 'Welcome Email',
                'path' => '@humhub/modules/user/views/emails/Welcome.php',
                'placeholders' => ['{displayName}', '{url}', '{siteName}', '{email}', '{password}'],
                'default_subject' => 'Welcome to {siteName}!',
                'default_body' => "Hi {displayName},\n\nWelcome to {siteName}!\n\nYour account has been created successfully.\n\nEmail: {email}\nPassword: {password}\n\nGet started here: {url}\n\nBest regards,\n{siteName} Team"
            ],
            'followed' => [
                'name' => 'New Follower Notification',
                'path' => '@humhub/modules/user/views/emails/Followed.php',
                'placeholders' => ['{displayName}', '{url}', '{siteName}', '{follower}'],
                'default_subject' => '{follower} is now following you',
                'default_body' => "Hi {displayName},\n\n{follower} is now following you on {siteName}.\n\nView their profile: {url}\n\nBest regards,\n{siteName} Team"
            ],
            'mentioned' => [
                'name' => 'Mention Notification',
                'path' => '@humhub/modules/user/views/emails/Mentioned.php',
                'placeholders' => ['{displayName}', '{contentTitle}', '{url}', '{siteName}', '{author}'],
                'default_subject' => '{author} mentioned you',
                'default_body' => "Hi {displayName},\n\n{author} mentioned you in: {contentTitle}\n\nView it here: {url}\n\nBest regards,\n{siteName} Team"
            ]
        ];
    }
}