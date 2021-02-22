<?php
namespace Ecjia\App\Push\Services;

/**
 * 后台权限API
 * @author royalwang
 *
 */
class AdminPurviewService
{

    /**
     * @param $options
     * @return array
     */
    public function handle($options)
    {
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