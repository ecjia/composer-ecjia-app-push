<?php
namespace Ecjia\App\Push\Lists;

use Ecjia\App\Push\EventFactory\EventFactory;

/**
 * 获取模板code
 * Class TemplateCodeList
 * @package Ecjia\App\Mail\Lists
 */
class TemplateCodeList
{

    public function __invoke()
    {
        $template_code_list = array();

        $factory = new EventFactory();

        $events  = $factory->getEvents();

        foreach ($events as $k => $event) {
            $template_code_list[$k]['code']        = $event->getCode();
            $template_code_list[$k]['name']        = $event->getName();
            $template_code_list[$k]['description'] = $event->getDescription();
        }

        return $template_code_list;
    }

}