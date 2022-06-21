<?php

class Flashcard
{
    protected int $id;
    protected string $question;
    protected string $answer;
    protected string $user_input;
    protected string $subject;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @return string
     */
    public function getUserinput(): string
    {
        return $this->user_input;
    }


    /**
     * @param string $question
     */
    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    /**
     * @param string $answer
     */
    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    public function isUserInputCorrect(): bool
    {
        if ($this->answer === $this->user_input) {
            return true;
        } else {
            return false;
        }
    }


    public static function create($question, $answer, $subject): Flashcard
    {
        $db = Db::get_Con();
        $sql = "INSERT INTO flashcard (question, answer, subject) VALUES (:question, :answer, :subject)";
        $stat = $db->prepare($sql);
        $stat->bindValue(':question', $question);
        $stat->bindValue(':answer', $answer);
        $stat->bindValue(':subject', $subject);
        $stat->execute();
        $id = $db->lastInsertId();
        $stat->closeCursor();
        return self::getbyID($id);
    }

    public static function getall(): array
    {
        $db = Db::get_Con();
        $sql = "SELECT * FROM flashcard";
        $stat = $db->prepare($sql);
        $stat->execute();
        $arr = $stat->fetchAll(8, self::class);
        $stat->closeCursor();
        return $arr;
    }

    public static function getbyID(int $id): Flashcard
    {
        $db = Db::get_Con();
        $sql = "SELECT * FROM flashcard
                WHERE id = :id";
        $stat = $db->prepare($sql);
        $stat->bindValue(':id', $id);
        $stat->execute();
        $person = $stat->fetchObject(self::class);
        $stat->closeCursor();
        return $person;

    }

    public function update(): void
    {
        $db = Db::get_Con();
        $sql = "UPDATE flashcard SET question = :question , answer = :answer
                WHERE id=:id";
        $stat = $db->prepare($sql);
        $stat->bindValue(':question', $this->question);
        $stat->bindValue(':answer', $this->answer);
        $stat->bindValue(':id', $this->id);
        $stat->execute();
        $stat->closeCursor();
    }

    public function delete(): void
    {
        $db = Db::get_Con();
        $sql = "DELETE FROM flashcard WHERE id = :id";
        $stat = $db->prepare($sql);
        $stat->bindValue(':id', $this->id);
        $stat->execute();
        $stat->closeCursor();
    }

    public static function getSubjects(): array
    {
        $db = Db::get_Con();
        $sql = "SELECT subject FROM flashcard group by subject";
        $stat = $db->prepare($sql);
        $stat->execute();
        $arr = $stat->fetchAll();
        $stat->closeCursor();
        return $arr;
    }

    public static function getFlashcardsbySubjects($arr): array
    {
        $in = str_repeat('?,', count($arr) - 1) . '?';
        $db = Db::get_Con();
        $sql = "SELECT * FROM flashcard WHERE subject IN ($in)";

        $stat = $db->prepare($sql);
//        $stat->bindParam(':in', $in);
        $stat->execute($arr);
        $arr = $stat->fetchAll(8, self::class);
        $stat->closeCursor();
        return $arr;
    }

    public function isanswer(int $learnbox_id):bool
    {
        $db = Db::get_Con();
        $sql = "SELECT user_input FROM learnbox_flashcards
                WHERE learnbox_id = :learnbox_id
                AND flashcard_id = :flashcard_id";
        $stat = $db->prepare($sql);
        $stat->bindValue(':learnbox_id', $learnbox_id);
        $stat->bindValue(':flashcard_id', $this->id);
        $stat->execute();
        $answer = $stat->fetch();
        $stat->closeCursor();
        if ($answer['user_input'] == '') {
            return true;
        } else {
            return false;
        }
    }


}






















