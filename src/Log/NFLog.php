<?php

namespace NFWP\Log;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class NFLog
{
    /**
     * @var Monolog\Logger
     */
    public $logger;

    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    private static $instance;

    private function __construct()
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            $this->logger = new Logger('NFWP');
            if (defined('NFWP_LOG_FILE') && file_exists(NFWP_LOG_FILE)) {
                if (!is_writable(NFWP_LOG_FILE)) {
                    throw new \Exception("Can not write to " . NFWP_LOG_FILE, 1);
                } else {
                    $path = NFWP_LOG_FILE;
                }
            } else {
                $path = ABSPATH . 'log.log';
            }
            $this->logger->pushHandler(new StreamHandler($path, Logger::INFO));
        }
    }

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * Adds a log record at an arbitrary level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  mixed   $level   The log level
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function log($level, $message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->log($level, $message, $context);
        }
    }

    /**
     * Adds a log record at the DEBUG level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function debug($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::DEBUG, $message, $context);
        }
    }

    /**
     * Adds a log record at the INFO level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function info($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::INFO, $message, $context);
        }
    }

    /**
     * Adds a log record at the NOTICE level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function notice($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::NOTICE, $message, $context);
        }
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function warn($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::WARNING, $message, $context);
        }
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function warning($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::WARNING, $message, $context);
        }
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function err($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::ERROR, $message, $context);
        }
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function error($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::ERROR, $message, $context);
        }
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function crit($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::CRITICAL, $message, $context);
        }
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function critical($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::CRITICAL, $message, $context);
        }
    }

    /**
     * Adds a log record at the ALERT level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function alert($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::ALERT, $message, $context);
        }
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function emerg($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::EMERGENCY, $message, $context);
        }
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function emergency($message, array $context = array())
    {
        if (defined('NFWP_LOG') && NFWP_LOG) {
            return $this->logger->addRecord(Logger::EMERGENCY, $message, $context);
        }
    }
}
