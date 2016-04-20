<?php

RC_Loader::load_app_class('notification.AndroidNotification', 'push', false);

class AndroidUnicast extends AndroidNotification {
	function __construct() {
		parent::__construct();
		$this->data["type"] = "unicast";
		$this->data["device_tokens"] = NULL;
	}

}

// end