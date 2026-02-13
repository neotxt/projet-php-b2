<?php

namespace Utils;

class Logger
{
    private const LOG_FILE = __DIR__ . '/../../logs/app.log';
    private const ERROR_FILE = __DIR__ . '/../../logs/error.log';

    public static function debug(string $message, array $context = [])
    {
        self::write('DEBUG', $message, $context, self::LOG_FILE);
    }

    public static function info(string $message, array $context = [])
    {
        self::write('INFO', $message, $context, self::LOG_FILE);
    }

    public static function warn(string $message, array $context = [])
    {
        self::write('WARN', $message, $context, self::LOG_FILE);
    }

    public static function error(string $message, array $context = [])
    {
        self::write('ERROR', $message, $context, self::LOG_FILE);
        self::write('ERROR', $message, $context, self::ERROR_FILE);
    }

    private static function write(string $level, string $message, array $context, string $logFile): void
    {
        $date = date('Y-m-d H:i:s');

        $contextString = !empty($context) ? json_encode($context) : '';

        $logLine = sprintf("[%s] [%s] %s %s" . PHP_EOL, $date, $level, $message, $contextString);

        file_put_contents($logFile, $logLine, FILE_APPEND | LOCK_EX);
    }
}
