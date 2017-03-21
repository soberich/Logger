<?php
namespace PSRLogger;
/*
 * Logger gets all activity 
 * and outputs it to a file, console window,
 * MySQL DB or any other stream.
 * 
 * @author SN
 */

class Logger extends AbstractLogger
{
    const DB_CONNECT_INCLUDE_PATH = 'db/db.php';
    const DB_CONFIG_INCLUDE_PATH = 'db/db.config.php';
    
    static private $ofStream;
    static private $link;
    
    static private $ostreamIsFile;
    static private $ostreamIsMySQL;
    static private $ostreamIsSTDOUT;
            
    public function __construct(bool $_ostreamIsFile = true, bool $_ostreamIsMySQL = false, bool $_ostreamIsSTDOUT = false)
    {
        
        if ($_ostreamIsFile)
        {
            self::$ostreamIsFile = true;
        }
        if ($_ostreamIsMySQL)
        {
            self::$ostreamIsMySQL = true;
        }
        if ($_ostreamIsSTDOUT)
        {
            self::$ostreamIsSTDOUT = true;
        }
        try
        {
            if (!$_ostreamIsFile && !$_ostreamIsMySQL && !$_ostreamIsSTDOUT)
            {
                throw new Exception("ATTENTION! You chose no output stream! Logs will not be kept!");
            }
        }
        catch (Exception $ex)
        {
            // This catch is excessive (not needed). Made for demo purposes
            echo "Exception: " . $ex->getMessage() . "\n";
            echo "in file: " . $ex->getFile() . "\n";
            echo "in line: " . $ex->getLine() . "\n";
        }
    }
    
    static public function setLogFile(string $fileName, string $path = null)
    {
        if($path != null && !is_dir($path))
        {
            return false;
        }
        self::$ofStream = fopen($path == null ? __DIR__.'/'.$fileName.'.log' : $path.'/'.$fileName,'a+');
        return true;
    }
    
    static public function selectDB($HOST = null, $LOGIN = null, $PASSWORD = null, $DBNAME = null)
    {
        if (!$HOST || !$LOGIN || !$DBNAME)
        {
            require self::DB_CONFIG_INCLUDE_PATH;
        }
        require self::DB_CONNECT_INCLUDE_PATH;
        
        return self::$link;
    }
    
    static public function log($level, $msg, array $context = [])
    {
        $t = date('Y-m-d H:i:s');
        $tWrapped = '['.$t.'] ';
        $levelWrapped = '['.$level.']';
        $contextMessage = self::interpolate($msg, $context);
        $reportStr = $tWrapped.'['.$levelWrapped.']'.$contextMessage."\n";
        self::write($reportStr, $t, $level, $contextMessage);
    }   
    
    static private function interpolate($msg, array $context = [])
    {
        // Wrapping array "context" keys with {}.
        $replace = [];

        foreach ($context as $key => $value)
        {
            $replace['{' . $key . '}'] = $value;
        }
        return strtr($msg, $replace);
    }
    
    static private function write($reportStr, $t, $level, $contextMessage)
    {
        if (self::$ostreamIsFile)
        {
            fwrite(self::$ofStream, $reportStr);
        }
        if (self::$ostreamIsMySQL)
        {
            $SQL = "INSERT INTO `logs`(`date`, `level`, `msg`) VALUES ('$t', '$level', '$contextMessage')";
            mysqli_query(self::$link, $SQL);
        }
        if (self::$ostreamIsSTDOUT)
        {
            fwrite(STDOUT, $reportStr);
        }
    }
}
