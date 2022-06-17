<?php

class Userinput
{
    protected int $id;
    protected int $flashcard_id;
    protected int $user_id;
    protected string $userinput;

    /**
     * @param int $id
     * @param int $flashcard_id
     * @param int $user_id
     * @param string $userinput
     */


    public static function create(int $flashcard_id, int $user_id, string $userinput): void
    {
        $db = Db::get_Con();
        $sql = "INSERT INTO userinput (flashcard_id, user_id, userinput)
                VALUES ( :flashcard_id,  :user_id, :userinput)";
        $stat = $db->prepare($sql);
        $stat->bindValue(':flashcard_id', $flashcard_id);
        $stat->bindValue(':user_id', $user_id);
        $stat->bindValue(':userinput', $userinput);
        $stat->execute();
        $stat->closeCursor();

    }

    public function getFlashcard(): Flashcard
    {
        return Flashcard::getbyID($this->flashcard_id);
    }

    public function isUserInputCorrect(): bool
    {
        $flashcard = $this->getFlashcard();
        $answer = $flashcard->getAnswer();


        if ($answer === $this->userInput) {
            return true;
        } else {
            return false;
        }
    }



}