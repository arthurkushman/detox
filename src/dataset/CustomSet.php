<?php

namespace detox\dataset;


use detox\exceptions\BadDictException;

class CustomSet implements SetContract
{
    private $words   = [];
    private $phrases = [];

    /**
     * @return array
     */
    public function getWords() : array
    {
        return $this->words;
    }

    /**
     * @param array $words
     * @throws BadDictException
     */
    public function setWords(array $words) : void
    {
        $this->checkDict($words);
        $this->words = $words;
    }

    /**
     * @return array
     */
    public function getPhrases() : array
    {
        return $this->phrases;
    }

    /**
     * @param array $phrases
     * @throws BadDictException
     */
    public function setPhrases(array $phrases) : void
    {
        $this->checkDict($phrases);
        $this->phrases = $phrases;
    }

    /**
     * @param array $dict
     * @throws BadDictException
     */
    private function checkDict(array $dict)
    {
        foreach ($dict as $score => $words) {
            if (is_numeric($score) === false) {
                throw new BadDictException('Keys of dict array must be string representation of float number, ex.: 0.9, 1.0 etc');
            }
            foreach ($words as $word) {
                if (is_string($word) === false) {
                    throw new BadDictException('Values in dict sub-array must be of type string');
                }
            }
        }
    }
}