<?php


namespace Ecjia\App\Push\NotificationFactory;


use RC_App;

class ComponentNamespace extends \Ecjia\Component\ComponentFactory\ComponentNamespace
{

    /**
     * 获取默认的目录
     */
    protected function getDefaultDir()
    {
        return RC_App::getAbsolutePath('push') . 'classes/Clients';
    }

    /**
     * 获取默认的命名空间
     */
    protected function getDefaultNamespace()
    {
        return 'Ecjia\App\Push\Clients';
    }

}