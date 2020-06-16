<?php
	function assign_adminlog_content() {
		ecjia_admin_log::instance()->add_object('config', __('配置', 'push'));
		ecjia_admin_log::instance()->add_object('message_template', __('消息模板', 'push'));
		ecjia_admin_log::instance()->add_object('push_evnet', __('消息事件', 'push'));
	}
//end