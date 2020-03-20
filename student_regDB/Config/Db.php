<?php
namespace Student\Config;

class Db
{
    private static $mysqli = null;
    private function __construct() 
    {  
        $mysqli = new \mysqli(DB_HOST, DB_USER_NAME, DB_PASSWORD, DB_NAME);
        if (!$mysqli) {
            throw new \Exception("Cannot connect to the database");
        }   
        static::$mysqli = $mysqli;  
    }

    public static function getMysqli()
    {
        if (static::$mysqli == null) {
            new self();
        }

        return static::$mysqli;
    }
}
// there will be a allocation whiling creating of object everytime so 
//we have static function which does not need to create a object every time wen every we call the function it will return mysqli. 