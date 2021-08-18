<?php

namespace Skidder\SkidderBundle\Formatter;


use Monolog\Formatter\JsonFormatter;

class SkidderFormatter extends JsonFormatter
{
    const LOGGING_SOURCE_APPLICATION = "application";
    const LOGGING_SOURCE_LIBRARY = "library";
    const LOGGING_SOURCE_DEPENDENCY = "dependency";

    const LOGGING_TYPE_EVENT = "event";
    const LOGGING_TYPE_ERROR = "error";

    const LOGGING_CHANNEL_APP = 'app';

    private $env;

    public function __construct(string $env)
    {
        $this->env = $env;

        parent::__construct();
    }

    public function format(array $record)
    {
        $record['level'] = strtolower($record['level_name']);
        $record['timestamp'] = $record['datetime']->format(\DateTime::ATOM);
        $record['type'] = self::LOGGING_TYPE_EVENT; # TODO
        $record['environment'] = $this->env;
        $record['file'] = $this->getFileAndLineNumber();

        $record['source'] = self::LOGGING_SOURCE_DEPENDENCY;
        if ($record['channel'] === self::LOGGING_CHANNEL_APP) {
            $record['source'] = self::LOGGING_SOURCE_APPLICATION;
        }

        if (array_key_exists('data', $record['context']) && is_array($record['context']['data'])) {
            $record['data'] = array_merge($record['data'], $record['context']['data']);
        }

        unset($record['channel']);
        unset($record['context']);
        unset($record['level_name']);
        unset($record['datetime']);
        unset($record['extra']);

        return parent::format($record);
    }

    private function getFileAndLineNumber() {
        $debug = debug_backtrace();

        $trace = isset($debug[4]) ? $debug[4] : null;

        $fileName = $trace ? basename($trace['file']) : '';
        $lineNumber = $trace ? $trace['line'] : '';

        return sprintf('%s:%s', $fileName, $lineNumber);
    }
}