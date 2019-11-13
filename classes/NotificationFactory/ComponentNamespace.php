<?php


namespace Ecjia\App\Push\NotificationFactory;


class ComponentNamespace extends \Ecjia\Component\ComponentFactory\ComponentNamespace
{

    /**
     * 获取默认的目录
     */
    protected function getDefaultDir()
    {
        return royalcms()->resourcePath('components/PushEvents');
    }

    /**
     * 获取默认的命名空间
     */
    protected function getDefaultNamespace()
    {
        return 'Ecjia\Resources\Components\PushEvents';
    }

}