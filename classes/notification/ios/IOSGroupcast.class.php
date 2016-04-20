<?php
RC_Loader::load_app_class('notification.IOSNotification', 'push', false);

class IOSGroupcast extends IOSNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "groupcast";
		$this->data["filter"]  = NULL;
	}
}

// end