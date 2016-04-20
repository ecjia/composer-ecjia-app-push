<?php

RC_Loader::load_app_class('notification.AndroidNotification', 'push', false);

class AndroidBroadcast extends AndroidNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}

// end