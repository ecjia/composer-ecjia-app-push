<?php


namespace Ecjia\App\Push\Controllers;


use Ecjia\App\Client\Helper;
use Ecjia\System\BaseController\EcjiaAdminController;

class AdminBase extends EcjiaAdminController
{
    protected $__FILE__;

    public function __construct()
    {
        parent::__construct();

        $this->__FILE__ = dirname(dirname(__FILE__));

        Helper::assign_adminlog_content();

    }
}