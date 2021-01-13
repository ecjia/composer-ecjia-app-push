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
        ecjia_admin_log::add_object('config', __('配置', 'push'));
        ecjia_admin_log::add_object('message_template', __('消息模板', 'push'));
        ecjia_admin_log::add_object('push_evnet', __('消息事件', 'push'));
    }
    
    
}