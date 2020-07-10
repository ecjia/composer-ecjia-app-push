<?php

namespace Ecjia\App\Push;

use RC_Service;
use Royalcms\Component\App\AppParentServiceProvider;

class PushServiceProvider extends  AppParentServiceProvider
{
    
    public function boot()
    {
        $this->package('ecjia/app-push');
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
    
    
}