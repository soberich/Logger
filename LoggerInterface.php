<?php
namespace PSRLogger;
/**
 * LoggerInterface is a parent for all further Logger implementations.
 * 
 * @author SN
 */
interface LoggerInterface
{
    public function       debug($msg, array $context = []); // mixed $level
    public function        info($msg, array $context = []);
    public function      notice($msg, array $context = []);
    public function     warning($msg, array $context = []);
    public function       error($msg, array $context = []);
    public function    critical($msg, array $context = []);
    public function       alert($msg, array $context = []);
    public function   emergency($msg, array $context = []);
    public static function log($level, $msg, array $context = []);
}
