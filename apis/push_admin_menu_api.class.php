<?php
defined('IN_ECJIA') or exit('No permission resources.');
/**
 * 后台文章菜单API
 * @author royalwang
 *
 */
class push_admin_menu_api extends Component_Event_Api
{

    public function call(&$options)
    {
        $menus = ecjia_admin::make_admin_menu('07_content', __('推送消息'), '', 14);
        
        $submenus = array(
//         	ecjia_admin::make_admin_menu('01_push', __('发送消息'), RC_Uri::url('push/admin/push_add'), 1)->add_purview('push_message'),
        	ecjia_admin::make_admin_menu('01_push', __('消息记录'), RC_Uri::url('push/admin/init'), 1)->add_purview('push_history_manage'),
        	ecjia_admin::make_admin_menu('01_push', __('消息事件'), RC_Uri::url('push/admin_event/init'), 2)->add_purview(''),
        	ecjia_admin::make_admin_menu('divider', '', '', 4)->add_purview(array('push_config_manage','push_template_manage'), 3),
        	ecjia_admin::make_admin_menu('02_push', __('消息模板'), RC_Uri::url('push/admin_template/init'), 4)->add_purview('push_template_manage'),
        	ecjia_admin::make_admin_menu('03_push', __('消息配置'), RC_Uri::url('push/admin_config/init'),5)->add_purview('push_config_manage')
        );
        
        $menus->add_submenu($submenus);
        
        return $menus;
    }
}

// end