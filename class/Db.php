<?php

class Db
{
    private static PDO $dbn;

    public static function get_Con(): PDO
    {
        if (!isset(self::$dbn)) {

            try {
                self::$dbn = new PDO(DB_DSN, DB_USER, DB_PW);
            } catch (PDOException $e) {
                echo "Connection faild: " . $e->getMessage();
            }
        }
        return self::$dbn;
    }

}