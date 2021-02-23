<?php

/**
 * 消息推送应用
 */

defined('IN_ECJIA') or exit('No permission resources.');

return array(
    'identifier'  => 'ecjia.push',
    'directory'   => 'push',
    'name'        => __('消息推送', 'push'),
    'description' => __('文章管理应用是一款‘海纳百川’、‘井然有序’的文章编写和发布文章，涉及多个模块和应用的软文撰写发布，是系统不可缺少的软文管理应用；应用提供了文章分类、列表、网店帮助、网店信息等核心功能，商家可对文章自定义添加或编辑分类、文章，而网店信息、网店帮助又是专门为用户提供简介、新闻、和帮助信息，从而为商家和用户节约了宝贵时间。', 'push'),                /* 描述对应的语言项 */
    'author'      => 'ECJIA TEAM',            /* 作者 */
    'website'     => 'http://www.ecjia.com',    /* 网址 */
    'version'     => '2.0.0',                    /* 版本号 */
    'copyright'   => 'ECJIA Copyright 2014.',
    'namespace'   => 'Ecjia\App\Push',
    'provider'    => 'PushServiceProvider',
    'autoload'    => array(
        'psr-4' => array(
            "Ecjia\\App\\Push\\" => "classes/"
        )
    ),
    'discover'    => array(
        'providers' => array(
            "Ecjia\\App\\Push\\PushServiceProvider"
        ),
        'aliases'   => [

        ]
    ),
);

// end