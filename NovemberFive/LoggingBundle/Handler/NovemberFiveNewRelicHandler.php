<?php

namespace NovemberFive\LoggingBundle\Handler;

use Monolog\Handler\NewRelicHandler;

class NovemberFiveNewRelicHandler extends NewRelicHandler
{
    final protected function write(array $record)
    {
        if (!$this->isNewRelicEnabled()) {
            return false;
        }

        parent::write($record);
    }

}