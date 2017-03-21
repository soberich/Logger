<?php
namespace PSRLogger;
/**
 * Just helper
 *
 * @author SN
 */

abstract class AbstractLogger implements LoggerInterface
{
    public function       alert($msg, array $context = [])
    {
        $this->log('alert', $msg, $context);
    }

    public function    critical($msg, array $context = [])
    {
        $this->log('critical', $msg, $context);
    }

    public function       debug($msg, array $context = [])
    {
        $this->log('debug', $msg, $context);
    }

    public function   emergency($msg, array $context = [])
    {
        $this->log('emergency', $msg, $context);
    }

    public function       error($msg, array $context = [])
    {
        $this->log('error', $msg, $context);
    }

    public function        info($msg, array $context = [])
    {
        $this->log('info', $msg, $context);
    }

    public function      notice($msg, array $context = [])
    {
        $this->log('notice', $msg, $context);
    }

    public function     warning($msg, array $context = [])
    {
        $this->log('warning', $msg, $context);
    }
}
