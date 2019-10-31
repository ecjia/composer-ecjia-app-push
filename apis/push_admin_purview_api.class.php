<?php
defined('IN_ECJIA') or exit('No permission resources.');
/**
 * 后台权限API
 * @author royalwang
 *
 */
class push_admin_purview_api extends Component_Event_Api
{
    
    public function call(&$options) {
//        $purviews = array(
//            array('action_name' => __('消息发送'), 'action_code' => 'push_message', 'relevance'   => ''),
//        	array('action_name' => __('删除消息'), 'action_code' => 'push_delete', 'relevance'   => ''),
//
//        	array('action_name' => __('消息记录管理'), 'action_code' => 'push_history_manage', 'relevance'   => ''),
//        	array('action_name' => __('消息模板管理'), 'action_code' => 'push_template_manage', 'relevance'   => ''),
//        	array('action_name' => __('消息配置管理'), 'action_code' => 'push_config_manage', 'relevance'   => ''),
//
//        	array('action_name' => __('消息事件管理'), 'action_code' => 'push_event_manage', 'relevance'   => ''),
//        	array('action_name' => __('新增消息事件'), 'action_code' => 'push_event_add', 'relevance'   => ''),
//        	array('action_name' => __('编辑消息事件'), 'action_code' => 'push_event_update', 'relevance'   => ''),
//        	array('action_name' => __('删除消息事件'), 'action_code' => 'push_event_delete', 'relevance'   => '')
//        );
        $purviews = array(
            array('action_name' => __('推送消息', 'push'), 'action_code' => 'push_message', 'relevance' => ''),
            array('action_name' => __('消息事件', 'push'), 'action_code' => 'push_event_manage', 'relevance' => ''),
            array('action_name' => __('消息记录管理', 'push'), 'action_code' => 'push_history_manage', 'relevance' => ''),
            array('action_name' => __('消息模板管理', 'push'), 'action_code' => 'push_template_manage', 'relevance' => ''),
            array('action_name' => __('消息模板更新', 'push'), 'action_code' => 'push_template_update', 'relevance' => ''),
            array('action_name' => __('消息模板删除', 'push'), 'action_code' => 'push_template_delete', 'relevance' => ''),
            array('action_name' => __('消息配置管理', 'push'), 'action_code' => 'push_config_manage', 'relevance' => '')
        );
        return $purviews;
    }
}

// end