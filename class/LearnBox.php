<?php

class LearnBox

{
    protected array $flashcards;

    /**
     * @param array $flashcards
     */
    public function __construct(array $flashcards)
    {
        $this->flashcards = $flashcards;
    }

    /**
     * @return array
     */
    public function getFlashcards(): array
    {
        return $this->flashcards;
    }

    public function getPerzentig(): float
    {
        $right = 0;
        foreach ($this->flashcards as $q) {
            if ($q->getUserInput()==='') {
                continue;
            }
            if ($q->isUserInputCorrect()) {
                $right++;
            }
        }
        return round( $right / count($this->flashcards) * 100,2);
    }


}