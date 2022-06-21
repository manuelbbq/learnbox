<?php

class LearnFlash
{
    protected int $lf_id;
    protected int $learnbox_id;
    protected int $flashcard_id;
    protected string $userinput;

    public static function create($learnbox_id, $flashcard_id):void
    {
        $db = Db::get_Con();
        $sql = "INSERT INTO learnbox_flashcards (learnbox_id, flashcard_id, user_input)
                VALUES (:learnbox_id, :flashcard_id, '')";
        $stat = $db->prepare($sql);
        $stat->bindValue(':learnbox_id', $learnbox_id);
        $stat->bindValue(':flashcard_id', $flashcard_id);
        $stat->execute();
        $stat->closeCursor();
    }

    public static function deletebyId($id):void
    {
        $db = Db::get_Con();
        $sql = "DELETE FROM learnbox_flashcards 
                WHERE learnbox_id = :id";
        $stat = $db->prepare($sql);
        $stat->bindValue(':id', $id);
        $stat->execute();
        $stat->closeCursor();
    }





}