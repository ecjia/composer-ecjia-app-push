<?php
/**
 * ECJIA消息模板模块
 */

defined('IN_ECJIA') or exit('No permission resources.');

class admin_template extends ecjia_admin {
	private $db_mail;
	
	public function __construct() {
		parent::__construct();
		
		RC_Lang::load('push');
		
		RC_Loader::load_app_func('global');
		assign_adminlog_content();
		
		$this->db_mail = RC_Loader::load_app_model('mail_templates_model');
	
		RC_Script::enqueue_script('tinymce');
		RC_Style::enqueue_style('chosen');
		RC_Style::enqueue_style('uniform-aristo');
		RC_Script::enqueue_script('jquery-chosen');
		RC_Script::enqueue_script('jquery-uniform');
		RC_Script::enqueue_script('jquery-validate');
		RC_Script::enqueue_script('jquery-form');
		RC_Script::enqueue_script('smoke');
		
		RC_Script::enqueue_script('jquery-dataTables-bootstrap');
		RC_Script::enqueue_script('push_template', RC_App::apps_url('statics/js/push_template.js', __FILE__), array(), false, false);
		
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('消息模板'), RC_Uri::url('push/admin_template/init')));
	}

	
	/**
	 * 消息模板
	 */
	public function init () {
		$this->admin_priv('push_template_manage');
		
		$this->assign('ur_here','消息模板');
		$this->assign('action_link', array('href'=>RC_Uri::url('push/admin_template/add'), 'text' => '添加消息模板'));
		ecjia_screen::get_current_screen()->remove_last_nav_here();
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('消息模板')));

		$data = $this->db_mail->field('template_id,template_code,template_subject,template_content')->where(array('type' => 'push'))->select();
		$this->assign('templates',$data);

		$this->assign_lang();
		$this->display('push_template_list.dwt');
	}
	
	/**
	 * 添加模板页面
	 */
	public function add() {
		$this->admin_priv('push_template_manage');
	
		$this->assign('ur_here', '添加消息模板');
		$this->assign('action_link', array('href'=>RC_Uri::url('push/admin_template/init'), 'text' => '消息模板列表'));
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('添加消息模板')));
		
		$this->assign('form_action', RC_Uri::url('push/admin_template/insert'));
	
		$this->assign('action', 'insert');
		
		$this->assign_lang();
		$this->display('push_template_info.dwt');
	}
	
	
	/**
	 * 添加模板处理
	 */
	public function insert() {
		$this->admin_priv('push_template_manage');
		
		$template_code = trim($_POST['template_code']);
		$subject       = trim($_POST['subject']);
		$content       = trim($_POST['content']);
		
		$titlecount = $this->db_mail->where(array('template_code'=>$template_code,'type'=>'push'))->count();
		if($titlecount > 0) {
			return $this->showmessage('该消息模板的名称已经存在！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		}
		
		$data = array(
			'template_code'    => $template_code,
			'template_subject' => $subject,
			'template_content' => $content,
			'last_modify'      => RC_Time::gmtime(),
			'type'             =>'push'
		);
		
		$tid=$this->db_mail->insert($data);
		
		ecjia_admin::admin_log('模板名是 '.$template_code.'，'.'消息主题是 '.$subject, 'add', 'message_template');
		
		$links[] = array('text' => '继续添加消息模板', 'href'=> RC_Uri::url('push/admin_template/add'));
		return $this->showmessage('添加消息模板成功！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('links' => $links, 'pjaxurl' => RC_Uri::url('push/admin_template/edit', array('id' => $tid))));
	}
	
	
	/**
	 * 模版修改
	 */
	public function edit() {
		$this->admin_priv('push_template_manage');

		$this->assign('ur_here', '编辑消息模板');
		$this->assign('action_link', array('href'=>RC_Uri::url('push/admin_template/init'), 'text' => '消息模板列表'));
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('编辑消息模板')));
		
		$tid= intval($_GET['id']);
		$template = $this->db_mail->find(array('template_id' => $tid));
		$this->assign('template', $template);
	
		$this->assign('form_action', RC_Uri::url('push/admin_template/update'));
		
		$this->assign_lang();
		$this->display('push_template_info.dwt');
	}
	
	/**
	 * 保存模板内容
	 */
	public function update() {
		$this->admin_priv('push_template_manage');
		
		$id= intval($_POST['id']);
		$template_code = trim($_POST['template_code']);
		$subject       = trim($_POST['subject']);
		$content       = trim($_POST['content']);
	
		$old_template_code = trim($_POST['old_template_code']);
		if ($template_code != $old_template_code) {
			$titlecount = $this->db_mail->where(array('template_code'=>$template_code,'type'=>'push'))->count();
			if ($titlecount > 0) {
				return $this->showmessage('该消息模板的名称已经存在！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
			}
		}

		$data = array(
			'template_code'    => $template_code,
			'template_subject' => $subject,
			'template_content' => $content,
			'last_modify'      => RC_Time::gmtime(),
			'type'             =>'push'
		);
		
		$this->db_mail->where(array('template_id' => $id))->update($data);
		
		ecjia_admin::admin_log('模板名是 '.$template_code.'，'.'消息主题是 '.$subject, 'edit', 'message_template');
	  	return $this->showmessage('更新消息模板成功！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS);
	}
	
	
	/**
	 * 删除消息模板
	 */
	public function remove()  {
		$this->admin_priv('push_template_manage');
	
		$id = intval($_GET['id']);
		
		$info = $this->db_mail->where(array('template_id' => $id))->find();
		$this->db_mail->where(array('template_id' => $id))->delete();
		
		ecjia_admin::admin_log('模板名是 '.$info['template_code'].'，'.'消息主题是 '.$info['template_subject'], 'remove', 'message_template');
		return $this->showmessage('删除消息模板成功！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS);
	}
}

//end