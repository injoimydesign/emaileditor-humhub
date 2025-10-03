<?php

namespace humhub\modules\emailtemplates;

use Yii;
use yii\base\BaseObject;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\modules\ui\menu\MenuEntry;
use humhub\modules\ui\menu\MenuLink;

class Events extends BaseObject
{
    /**
     * Add menu entry to admin menu
     * @param $event
     */
    public static function onAdminMenuInit($event)
    {
        /** @var AdminMenu $menu */
        $menu = $event->sender;
        
        $menu->addEntry(new MenuLink([
            'id' => 'emailtemplates',
            'label' => Yii::t('EmailtemplatesModule.base', 'Email Templates'),
            'url' => ['/emailtemplates/admin/index'],
            'icon' => 'fa-envelope',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'emailtemplates'),
            'sortOrder' => 650,
        ]));
        
        $menu->addEntry(new MenuLink([
            'id' => 'emailstyles',
            'label' => Yii::t('EmailtemplatesModule.base', 'Email Style Designer'),
            'url' => ['/emailtemplates/style/index'],
            'icon' => 'fa-paint-brush',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'emailtemplates' && Yii::$app->controller->id == 'style'),
            'sortOrder' => 651,
        ]));
    }
}