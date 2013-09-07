<?php

namespace Tangler\Module\Mollie;

use Tangler\Core\AbstractModule;
use Tangler\Core\Interfaces\ModuleInterface;

class Module extends AbstractModule implements ModuleInterface
{
    public function Init()
    {
        $this->setKey('mollie');
        $this->setLabel('Mollie module');
        $this->setDescription('Send SMS messages through Mollie / MessageBird');
        $this->setImageUrl('http://www.appmerce.com/media/catalog/product/cache/5/image/234x234/9df78eab33525d08d6e5fb8d27136e95/m/o/mollie.png');

        // No triggers
        $this->setTriggers(array());

        $this->setActions(array(
            new \Tangler\Module\Mollie\SendMessageAction()
        ));
    }
}
