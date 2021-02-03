<?php
namespace Ecjia\App\Push\Lists;

use Ecjia\App\Push\EventFactory\EventFactory;
use Ecjia\App\Push\Models\PushTemplateModel;

/**
 * 获取模板code
 * Class TemplateCodeList
 * @package Ecjia\App\Mail\Lists
 */
class TemplateCodeAvailableOptions
{

    public function __invoke()
    {
        $template_code_list = array();

        $factory = new EventFactory();

        $events  = $factory->getEvents();

        $template_codes = PushTemplateModel::channel_push()->select('template_code', 'template_subject')->pluck('template_code')->toArray();

        foreach ($events as $event) {
            if (empty($template_codes) || ! in_array($event->getCode(), $template_codes)) {
                $template_code_list[$event->getCode()] = $event->getName() . ' [' . $event->getCode() . ']';
            }
        }

        return $template_code_list;
    }

}