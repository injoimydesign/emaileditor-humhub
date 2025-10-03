<?php

use humhub\modules\emailtemplates\Events;
use humhub\modules\admin\widgets\AdminMenu;

return [
    'id' => 'emailtemplates',
    'class' => 'humhub\modules\emailtemplates\Module',
    'namespace' => 'humhub\modules\emailtemplates',
    'events' => [
        [
            'class' => AdminMenu::class,
            'event' => AdminMenu::EVENT_INIT,
            'callback' => [Events::class, 'onAdminMenuInit']
        ]
    ]
];