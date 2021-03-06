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


    public static function getUserbyName($name): mixed
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

    public static function getUserbyId($id): User
    {
        $db = Db::get_Con();
        $sql = 'SELECT * FROM user WHERE userid = :id';
        $stat = $db->prepare($sql);
        $stat->bindValue(':id', $id);
        $stat->execute();
        $user = $stat->fetchObject(self::class);
        $stat->closeCursor();
        return $user;
    }

    public function checkpw($password): bool
    {
        if (password_verify($password, $this->password)) {
            return true;
        } else {
            return false;
        }
    }


    public static function create(string $name, string $password): User
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $db = Db::get_Con();
        $sql = 'INSERT INTO user (name, password) VALUES (:name, :hash)';
        $stat = $db->prepare($sql);
        $stat->bindValue(':name', $name);
        $stat->bindValue(':hash', $hash);
        $stat->execute();
        $id = $db->lastInsertId();
        $stat->closeCursor();
        return self::getUserbyId($id);
    }

    public function changePassbyId(string $password): void
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $db = Db::get_Con();
        $sql = 'UPDATE user SET password = :hash WHERE userid = :id';
        $stat = $db->prepare($sql);
        $stat->bindValue(':hash', $hash);
        $stat->bindValue(':id', $this->userid);
        $stat->execute();
        $stat->closeCursor();
    }

    public static function checkIfUserNameExist(string $name): bool
    {
        $db = Db::get_Con();
        $sql = 'SELECT * FROM user WHERE name = :name';
        $stat = $db->prepare($sql);
        $stat->bindValue(':name', $name);
        $stat->execute();
        if ($stat->fetchColumn()) {
            $stat->closeCursor();
            return true;
        } else {
            $stat->closeCursor();
            return false;
        }

    }

    public function getLearnboxes()
    {
        
    }



}