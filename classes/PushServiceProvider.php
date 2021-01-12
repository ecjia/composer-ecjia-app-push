<?php

namespace Ecjia\App\Push;

use ecjia_admin_log;
use RC_Service;
use Royalcms\Component\App\AppParentServiceProvider;

class PushServiceProvider extends  AppParentServiceProvider
{
    
    public function boot()
    {
        $this->package('ecjia/app-push');

        $this->assignAdminLogContent();
    }
    
    public function register()
    {
        $this->registerAppService();
    }

    protected function registerAppService()
    {
        RC_Service::addService('admin_purview', 'push', 'Ecjia\App\Push\Services\AdminPurviewService');
        RC_Service::addService('push_event_send', 'push', 'Ecjia\App\Push\Services\PushEventSendService');
        RC_Service::addService('admin_menu', 'push', 'Ecjia\App\Push\Services\AdminMenuService');
    }

    protected function assignAdminLogContent()
    {
        ecjia_admin_log::add_object('mobile_device', __('移动设备', 'push'));
        ecjia_admin_log::add_object('mobile_config', __('应用配置', 'push'));
        ecjia_admin_log::add_object('mobile_manage', __('客户端管理', 'push'));
        ecjia_admin_log::add_object('mobile_toutiao', __('客户端标题', 'push'));
    }
    
    
}