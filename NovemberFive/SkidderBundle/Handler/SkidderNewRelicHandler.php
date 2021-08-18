<?php

namespace NovemberFive\SkidderBundle\Handler;

use Monolog\Handler\NewRelicHandler;

class SkidderNewRelicHandler extends NewRelicHandler
{
    final protected function write(array $record)
    {
        if (!$this->isNewRelicEnabled()) {
            return false;
        }

        parent::write($record);
    }

}