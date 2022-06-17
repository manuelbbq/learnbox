<?php

class LearnBox

{

    protected int $learnbox_id;
    protected int $user_id;
    protected int $date;

    /**
     * @return array
     */
    public static function create($user_id, $flasharray): LearnBox
    {
        $db = Db::get_Con();
        $sql = "INSERT INTO learnboxs (user_id, createdate)
                VALUES (:user_id, CURRENT_TIMESTAMP)";
        $stat = $db->prepare($sql);
        $stat->bindValue(':user_id', $user_id);
        $stat->execute();
        $id = $db->lastInsertId();
        $stat->closeCursor();

        foreach ($flasharray as $flashcard) {
            LearnFlash::create($id, $flashcard->getId());
        }
        return self::getLearnboxbyId($id);
    }

    public static function getLearnboxbyId($id): LearnBox
    {
        $db = Db::get_Con();
        $sql = 'SELECT * FROM learnboxs WHERE learnbox_id = :id';
        $stat = $db->prepare($sql);
        $stat->bindValue(':id', $id);
        $stat->execute();
        $user = $stat->fetchObject(self::class);
        $stat->closeCursor();
        return $user;
    }

    public function getFlashcards(): array
    {
        $db = Db::get_Con();
        $sql = 'SELECT flashcard.id,flashcard.question, flashcard.answer, learnbox_flashcards.user_input FROM flashcard 
                LEFT JOIN learnbox_flashcards  on flashcard.id = learnbox_flashcards.flashcard_id
                WHERE learnbox_flashcards.learnbox_id = :id';
        $stat = $db->prepare($sql);
        $stat->bindValue(':id', $this->learnbox_id);
        $stat->execute();
        $flashcards = $stat->fetchAll(8, 'Flashcard');
        $stat->closeCursor();
        return $flashcards;

    }

    public function setUserInput($userinput,$flashcard_id): void
    {
        $db = Db::get_Con();
        $sql = 'UPDATE learnbox_flashcards SET user_input = :userinput 
                WHERE learnbox_id= :learnbox_id AND flashcard_id = :flashcard_id';
        $stat = $db->prepare($sql);
        $stat->bindValue(':userinput', $userinput);
        $stat->bindValue(':flashcard_id', $flashcard_id);
        $stat->bindValue(':learnbox_id', $this->learnbox_id);
        $stat->execute();
    }


    public function getPerzentig(): float
    {
        $right = 0;
        foreach ($this->flashcards as $q) {
            if ($q->getUserInput() === '') {
                continue;
            }
            if ($q->isUserInputCorrect()) {
                $right++;
            }
        }
        return round($right / count($this->flashcards) * 100, 2);
    }


}