<?php

class User
{
    protected int $userid;
    protected string $name;
    protected string $password;

    /**
     * @return int
     */
    public function getUserid(): int
    {
        return $this->userid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }







    public static function getUserbyName($name):User
    {
        $db = Db::get_Con();
        $sql = 'SELECT * FROM user WHERE name = :name';
        $stat = $db->prepare($sql);
        $stat->bindValue(':name', $name);
        $stat->execute();
        $user = $stat->fetchObject(self::class);
        $stat->closeCursor();
        return $user;
    }

    public function checkpw($password):bool
    {
        if ($password === $this->password){
            return true;
        } else{
            return false;
        }
    }




}