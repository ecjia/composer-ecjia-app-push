<?php
/**
 * ECJIA消息模块
 */
defined('IN_ECJIA') or exit('No permission resources.');

class admin extends ecjia_admin {

	private $db_push;
	public function __construct() {
		parent::__construct();
		
		RC_Lang::load('push');
		
		$this->db_push = RC_Loader::load_app_model('push_message_model');
		
		RC_Loader::load_app_class('push_send', null, false);
		
		RC_Loader::load_app_class('mobile_manage','mobile', false);
		
		/* 加载全局 js/css */
		RC_Script::enqueue_script('jquery-validate');
		RC_Script::enqueue_script('jquery-form');
		RC_Script::enqueue_script('smoke');
		
		RC_Style::enqueue_style('chosen');
		RC_Style::enqueue_style('uniform-aristo');
		RC_Script::enqueue_script('jquery-uniform');
		RC_Script::enqueue_script('jquery-chosen');
		RC_Style::enqueue_style('datepicker', RC_Uri::admin_url('statics/lib/datepicker/datepicker.css'));
		RC_Script::enqueue_script('bootstrap-datepicker', RC_Uri::admin_url('statics/lib/datepicker/bootstrap-datepicker.min.js'));
		RC_Script::enqueue_script('push', RC_App::apps_url('statics/js/push.js', __FILE__), array(), false, true);
		
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('消息记录'), RC_Uri::url('push/admin/init')));
	}

	/**
	 * 显示发送记录的
	 */
	public function init() {
		$this->admin_priv('push_history_manage');
				
		$applistdb = $this->get_applist();

        foreach ($applistdb['item'] as $key => $val) {
        	$appcount = $this->db_push->where(array('app_id' =>$val['app_id']))->count();
        	$applistdb['item'][$key]['count'] = $appcount;
        }
		
		$appid = $_GET['appid'];
		if(empty($appid)) {
			$appid = $applistdb['item'][0]['app_id'];
		}
		
		$listdb = $this->get_pushlist($appid);
		$this->assign('listdb',$listdb);
		
		$this->assign('search_action', RC_Uri::url('push/admin/init'));
		$this->assign('applistdb',$applistdb);
		
		$this->assign('action_link', array('text' => '添加推送消息', 'href'=> RC_Uri::url('push/admin/push_add', array('appid' => $appid))));
		$this->assign('ur_here', '消息记录列表');
		ecjia_screen::get_current_screen()->remove_last_nav_here();
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('消息记录')));
		
		$this->assign_lang();
		$this->display('push_send_history.dwt');
	}
					
	/**
	 * 发送消息页面
	 */
	public function push_add() {
		$this->admin_priv('push_message');
		$appid = $_GET['appid'];
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('消息推送')));
		$this->assign('ur_here','添加消息推送');
		$this->assign('action_link', array('text' => '消息记录列表', 'href' => RC_Uri::url('push/admin/init', array('appid' => $appid))));
		
		$device_list = $this->get_device_name();
		$this->assign('device_list', $device_list);
		$this->assign('action', 'add');
		$this->assign('appid', $appid);
		
		$extradata['open_type'] = 0;
		$extradata['target'] = 0;
		$this->assign('extradata', $extradata['open_type']);
		$this->assign('target', $extradata['target']);
	
		$this->assign('form_action', RC_Uri::url('push/admin/push_insert'));
		
		$this->assign_lang();
		$this->display('push_send.dwt');
	}
	
	
	/**
	 *copy消息页面
	 */
	public function push_copy() {
		$this->admin_priv('push_message');
		
		$appid = $_GET['appid'];
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('消息推送')));
		$this->assign('ur_here','添加消息推送');
		$this->assign('action_link', array('text' => '消息记录列表', 'href' => RC_Uri::url('push/admin/init', array('appid' => $appid))));
		
		$device_list = $this->get_device_name();
		$this->assign('device_list', $device_list);
		
		$message_id = intval($_GET['message_id']);
		
		$push = $this->db_push->find(array('message_id' => $message_id));
// 		if ($push['device_client'] == 'iphone') {
// 			$push['device_client'] = 'iPhone';
// 		} elseif ($push['device_client'] == 'android') {
// 			$push['device_client'] = 'Andriod';
// 		} elseif ($push['device_client'] == 'ipad') {
// 			$push['device_client'] = 'iPad';
// 		}

		$extradata = unserialize($push['extradata']);
		unset($push['extradata']);
		foreach ($extradata as $key=>$val){
			$push[$key] = $val;
		}
		$this->assign('extradata', $push['extra_fields']);

		if($push['extra_fields']['open_type'] == 'webview') {
			$push['url'] = $push['extra_fields']['url'];
		} elseif ($push['extra_fields']['open_type'] == 'search') {
			$push['keyword'] = $push['extra_fields']['keyword'];
		} elseif ($push['extra_fields']['open_type'] == 'goods_comment' || $push['extra_fields']['open_type'] == 'goods_detail') {
			$push['goods_id'] = $push['extra_fields']['goods_id'];
		} elseif ($push['extra_fields']['open_type'] == 'orders_detail') {
			$push['order_id'] = $push['extra_fields']['order_id'];
		} elseif ($push['extra_fields']['open_type'] == 'goods_list') {
			$push['category_id'] = $push['extra_fields']['category_id'];
		}

		$this->assign('push', $push);
		$this->assign('form_action', RC_Uri::url('push/admin/push_insert'));
		$this->assign_lang();
		
		$this->display('push_send.dwt');
	}
			
	/**
	 * 发送消息处理
	 * target 推送对象
	 * 所有人：0
	 * 单播：1
	 * 用户：2
	 * 管理员：3
	 * 
	 * action 推送行为
	 */
	public function push_insert() {
		$this->admin_priv('push_message');
	       
		$appid          = intval($_POST['appid']);
		$app            = mobile_manage::make($appid);
		
		$device_client	= $app->getClient();
		$title	        = trim($_POST['title']);
		$content		= trim($_POST['content']);
		$priority		= intval($_POST['priority']);
		$target		    = intval($_POST['target']);//推送对象
		$devive_token   = $_POST['devive_token'];//Device Token
		$user_id		= intval($_POST['user_id']);//用户id
		$admin_id	    = intval($_POST['admin_id']);//管理员id
		
		$action		    = $_POST['action'];//推送行为
		$url			= $_POST['url'];//网址
		$keyword		= $_POST['keyword'];//关键字
		$category_id	= intval($_POST['category_id']);//商品分类ID
		$goods_id		= intval($_POST['goods_id']);//商品ID
		$order_id		= intval($_POST['order_id']);//订单ID
		
		if ($action) {
		    $custom_fields = array('open_type' => $action);
		}
		
		if ($action == 'webview') {
			if (empty($url)) {
				$this->showmessage(__('请输入网址！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
			}
			$custom_fields['url'] = $url;
		} elseif ($action == 'search') {
			if (empty($keyword)) {
				$this->showmessage(__('请输入关键字！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
			}
			$custom_fields['keyword'] = $keyword;
		} elseif ($action == 'goods_list') {
			if (empty($category_id)) {
				$this->showmessage(__('请输入商品分类ID！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
			}
			$custom_fields['category_id'] = $category_id;
		} elseif ($action == 'goods_comment' || $action == 'goods_detail') {
			if (empty($goods_id)) {
				$this->showmessage(__('请输入商品ID！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
			}
			$custom_fields['goods_id'] = $goods_id;
		} elseif ($action == 'orders_detail') {
			if (empty($order_id)) {
				$this->showmessage(__('请输入订单ID！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
			}
			$custom_fields['order_id'] = $order_id;
		}

		if ($target == 3 & $target == 2) {
		    if ($target == 3) {
		        if (empty($admin_id)) {
		            $this->showmessage(__('请输入管理员ID！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		        }
		        
		        $device_info = RC_Api::api('mobile', 'device_info', array('admin_id' => $admin_id));
		        if (empty($device_info['device_client']) || empty($device_info['devive_token'])) {
		            $this->showmessage(__('未找到该用户的Device Token！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		        }
		    } elseif ($target == 2) {
		        if (empty($user_id)) {
		            $this->showmessage(__('请输入用户ID！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		        }
		        
		        $device_info = RC_Api::api('mobile', 'device_info', array('user_id' => $user_id));
		        if (empty($device_info['device_client']) || empty($device_info['devive_token'])) {
		            $this->showmessage(__('未找到该用户的Device Token！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		        }
		    }
		    
		    if ($device_info['device_client'] == 'android') {
		        $result = push_send::make($appid)->set_client(push_send::CLIENT_ANDROID)->set_field($custom_fields)->send($device_info['devive_token'], $title, $content, 0, $priority);
		    } elseif ($device_info['device_client'] == 'iphone') {
		        $result = push_send::make($appid)->set_client(push_send::CLIENT_IPHONE)->set_field($custom_fields)->send($device_info['devive_token'], $title, $content, 0, $priority);
		    } elseif($device_info['device_client'] == 'ipad') {
		        $result = push_send::make($appid)->set_client(push_send::CLIENT_IPAD)->set_field($custom_fields)->send($device_info['devive_token'], $title, $content, 0, $priority);
		    }
		} else {
		    if (empty($device_client)) {
		        $this->showmessage(__('该用户未绑定移动端设备！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		    } 
		    
		    if ($target == 1) {
		        if (empty($devive_token)) {
		            $this->showmessage(__('请输入Device Token！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		        }
		        
		        $token_len = strlen($devive_token);
		        if ($device_client == push_send::CLIENT_ANDROID && $token_len != 44) {
		            $this->showmessage(__('输入Device Token的长度不合法！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		        } elseif (($device_client == push_send::CLIENT_IPHONE && $token_len != 64) || ($device_client == push_send::CLIENT_IPAD && $token_len != 64)) {
		            $this->showmessage(__('请输入Device Token的长度不合法！'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		        }
		        
		        if ($device_client == 'android') {
		            $result = push_send::make($appid)->set_client(push_send::CLIENT_ANDROID)->set_field($custom_fields)->send($devive_token, $title, $content, 0, $priority);
		        } elseif ($device_client == 'iphone') {
		            $result = push_send::make($appid)->set_client(push_send::CLIENT_IPHONE)->set_field($custom_fields)->send($devive_token, $title, $content, 0, $priority);
		        } elseif($device_client == 'ipad') {
		            $result = push_send::make($appid)->set_client(push_send::CLIENT_IPAD)->set_field($custom_fields)->send($devive_token, $title, $content, 0, $priority);
		        }
		        
		    }
		     else {
		        if ($device_client == 'android') {
		            $result = push_send::make($appid)->set_client(push_send::CLIENT_ANDROID)->set_field($custom_fields)->broadcast_send($title, $content, 0, $priority);
		        } elseif ($device_client == 'iphone') {
		            $result = push_send::make($appid)->set_client(push_send::CLIENT_IPHONE)->set_field($custom_fields)->broadcast_send($title, $content, 0, $priority);
		        } elseif($device_client == 'ipad') {
		            $result = push_send::make($appid)->set_client(push_send::CLIENT_IPAD)->set_field($custom_fields)->broadcast_send($title, $content, 0, $priority);
		        }
		    }
		}

		if (is_ecjia_error($result)) {
			$this->showmessage($result->get_error_message(), ecjia_admin::MSGTYPE_JSON | ecjia_admin::MSGSTAT_ERROR);
		} else {
			$this->showmessage('推送消息成功！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('push/admin/init')));
		}
	}
	
	/**
	 * 删除消息记录
	 */
	public function remove() {
		$this->admin_priv('push_delete');

		$message_id = intval($_GET['message_id']);
		$this->db_push->where(array('message_id' => $message_id))->delete();
			
		$this->showmessage('删除消息成功！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS);
	}
	
	/**
	 * 推送消息
	 */
	public function push() {
		$this->admin_priv('push_message');
	
		$message_id = intval($_GET['message_id']);
// 		$content = $this->db_push->field('device_client')->find(array('message_id' => $message_id));
		$appid = intval($_GET['appid']);
		$result = push_send::make($appid)->resend($message_id);
	
		if (is_ecjia_error($result)) {
			$this->showmessage($result->get_error_message(), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR, array('pjaxurl' => RC_Uri::url('push/admin/init', array('appid' => $appid))));
		} else {
			$this->showmessage('推送消息成功！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('push/admin/init', array('appid' => $appid))));
		}
	}
	
	/**
	 * 批量推送消息
	 */
	public function batch_resend() {
		$this->admin_priv('push_message');
	
		$messageids = explode(",",$_POST['message_id']);
		$appid = $_GET['appid'];
		push_send::make($appid)->batch_resend($messageids);
		
		$this->showmessage('已批量推送完毕', ecjia_admin::MSGTYPE_JSON | ecjia_admin::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('push/admin/init', array('appid' => $appid))));
	}
	
	/**
	 * 批量删除消息记录
	 */
	public function batch(){
		$this->admin_priv('push_delete');
	
		$success = $this->db_push->in(array('message_id' => $_POST['message_id']))->delete();
		if ($success) {
			$this->showmessage('批量操作成功！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS,array('pjaxurl' => RC_Uri::url('push/admin/init')));
		}
	}
	
	/**
	 * 获取所有device_name
	 */
	private function get_device_name() {
		return array('Android', 'iPhone', 'iPad');
	}
	
	
	private function get_applist() {
		$arr = array();
		$umeng_push = 'umeng-push';
		$applist= mobile_manage::getMobileAppList($umeng_push);
		
		if (!empty($applist)) {
			foreach ($applist as $rows) {
				$arr[] = $rows;
			}
		}
		return array('item' => $arr);
	}
	
	/**
	 * 消息记录
	 */
	private function get_pushlist($appid) {
		$dbpush = RC_Loader::load_app_model('push_message_model');
		
		$where = array();
		
		$filter['keywords'] = empty($_GET['keywords']) ? '' : trim($_GET['keywords']);
		$filter['appid'] = intval($appid);
		$status = !empty($_GET['status']) ? $_GET['status'] : '';
		$filter['in_status']='';
		
		if(!empty($status) || (isset($status) && trim($status)==='0' )){
			$where['in_status']   =  $status;
			$filter['in_status']  =  $status;
		}
		
		if ($filter['keywords']) {
			$where[] = "title LIKE '%" . mysql_like_quote($filter['keywords']) . "%'";
		}
		
		$where['app_id'] = $filter['appid'];

// 		$field = "SUM(IF(app_id=".$filter['appid'].",1,0)) AS android";
// 		$field = "SUM(IF(app_id=,1,0)) AS count";

// 		$msg_count = $dbpush->field($field)->find();

// 		$msg_count = array(
// 			'count'	=> empty($msg_count['count']) ? 0 : $msg_count['count'],
// 		);
		
		$count = $dbpush->where($where)->count();
		RC_Loader::load_sys_class('ecjia_page', false);
		$page = new ecjia_page($count, 15, 6);
		
		$row = $dbpush->where($where)->order(array('add_time'=>'desc'))->limit($page->limit())->select();
		if (!empty($row)) {
			foreach ($row AS $key => $val) {
				$row[$key]['add_time'] = RC_Time::local_date(ecjia::config('time_format'), $val['add_time']);
				$row[$key]['push_time'] = RC_Time::local_date(ecjia::config('time_format'), $val['push_time']);
// 				if ($row[$key]['device_client'] == 'android') {
// 					$row[$key]['device_client'] = 'Android';
// 				}elseif ($row[$key]['device_client'] == 'iphone') {
// 					$row[$key]['device_client'] = 'iPhone';
// 				}elseif ($row[$key]['device_client'] == 'ipad'){
// 					$row[$key]['device_client'] = 'iPad';
// 				}
			}
		}
	
		$arr = array('item' => $row, 'filter' => $filter, 'page' => $page->show(5), 'desc' => $page->page_desc());
		return $arr;
	}
}

//end