<?php

require 'MyAutoloader.php';

/**
 * Testings and trials
 * __construct
 * @param boolean $_ostreamIsFile     to put logs to file
 * @param boolean $_ostreamIsMySQL    to put logs to MySQL
 * @param boolean $_ostreamIsSTDOUT   to put logs to STDOUT
 * 
 * @access  public
**/
$obj = new \PSRLogger\Logger(true, true, false);

/** 
 * @param string  $fileName           file name to write to (with no extention)
 * @param string  $path               directory with file to write to
 * 
 * @return boolean                    true if successful; false if directory
 *                                    $path does not exist
 * @access  public
**/
$obj->setLogFile('logs');
/**
 * @param string  $HOST               These are not necessary parameters
 * @param string  $LOGIN              as less safer alternative for 
 * @param string  $PASSWORD           setting up DB connection by passing
 * @param string  $DBNAME             parameters straight to method
 * 
 * @return mysqli object              if successful
 *
 * @access  public
 **/
$obj->selectDB();

$str = "any test message";

/**
 * All methods are implementations of main log() method of LoggerInterface
 * 
 * @param string  $msg                The main contents of the message
 * @param array   $context            These are not necessary parameters
 *                                    additional detail which can allow to 
 *                                    specify more precise details of the 
 *                                    log event. Array will be merged with
 *                                    $msg before getting into log stream.
 * 
 * @return mysqli object              if successful
 *
 * @access  public
 **/

$obj->debug($str);
$obj->info($str);
$obj->notice($str);
$obj->warning($str);
$obj->error($str);
$obj->critical($str);
$obj->alert($str);
$obj->emergency($str);
$obj->alert($str);
