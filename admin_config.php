<?php
/**
 * ECJIA消息模块
 */

defined('IN_ECJIA') or exit('No permission resources.');

class admin_config extends ecjia_admin {

	private $db_mobile_manage;
	
	public function __construct() {
		parent::__construct();
		
		RC_Loader::load_app_func('global');
		assign_adminlog_content();
	
		$this->db_mobile_manage = RC_Loader::load_app_model('mobile_manage_model', 'mobile');
		
		RC_Script::enqueue_script('jquery-validate');
		RC_Script::enqueue_script('jquery-form');
		RC_Script::enqueue_script('smoke');
		RC_Style::enqueue_style('chosen');
		RC_Style::enqueue_style('uniform-aristo');
		RC_Script::enqueue_script('jquery-uniform');
		RC_Script::enqueue_script('jquery-chosen');
		
		RC_Script::enqueue_script('push_config', RC_App::apps_url('statics/js/push_config.js', __FILE__), array(), false, true);
	}

					
	/**
	 * 消息配置页面
	 */
	public function init () {
	    $this->admin_priv('push_config_manage');
	   
		$this->assign('ur_here', '消息配置');
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('消息配置')));

    	$this->assign('config_appname', ecjia::config('app_name'));//应用名称
    	$this->assign('config_apppush', ecjia::config('app_push_development'));
    	
    	$mobile_manage = $this->db_mobile_manage->select();
    	
    	
    	
    	$push_order_placed_apps = ecjia::config('push_order_placed_apps');
    	$apps_id = explode(',', $push_order_placed_apps);
    	$apps_group = $this->db_mobile_manage->where(array('app_id' => $apps_id))->select();
    	
    	$this->assign('mobile_manage',     	$mobile_manage);
    	$this->assign('apps_group',     	$apps_group);
    	$this->assign('config_pushplace',   ecjia::config('push_order_placed'));//客户下单
    	$this->assign('config_pushpay',     ecjia::config('push_order_payed'));//客户付款
    	$this->assign('config_pushship',    ecjia::config('push_order_shipped'));//商家发货
    	$this->assign('config_pushsignin',	ecjia::config('push_user_signin'));//用户注册

		$this->assign('form_action', RC_Uri::url('push/admin_config/update'));
		
		$this->assign_lang();
		return $this->display('push_config.dwt');
	}
		
	/**
	 * 处理消息配置
	 */
	public function update() {
		$this->admin_priv('push_config_manage');
		
		ecjia_config::instance()->write_config('app_name',             $_POST['app_name']);
		ecjia_config::instance()->write_config('app_push_development', $_POST['app_push_development']);
		
		$apps_id = '';
		if (!empty($_POST['app_id'])) {
			foreach ($_POST['app_id'] as $val) {
				$apps_id .= $val.',';
			}
			$apps_id = substr($apps_id, 0, -1);
		}
		ecjia_config::instance()->write_config('push_order_placed_apps', $apps_id);
		
		ecjia_config::instance()->write_config('push_order_placed',    	intval($_POST['config_order']));
		ecjia_config::instance()->write_config('push_order_payed',     	intval($_POST['config_money']));
		ecjia_config::instance()->write_config('push_order_shipped',	intval($_POST['config_shipping']));
		ecjia_config::instance()->write_config('push_user_signin',     	intval($_POST['config_user']));
		
		ecjia_admin::admin_log('推送消息>消息配置', 'setup', 'config');
		return $this->showmessage('更新消息配置成功！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('push/admin_config/init')));
	}
}

//end