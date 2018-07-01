<?php

namespace detox\core;


use detox\dataset\SetContract;
use detox\source\Text;

/**
 * Class Words
 * @package detox\core
 *
 * @property Text text
 */
class Words
{

    public const MAX_SCORE        = 1;
    public const ASTERISKS_MIDDLE = 0.8;
    public const ASTERISKS_LEFT   = 0.5;
    public const ASTERISKS_RIGHT  = 0.6;

    protected $dataSet;
    protected $score = 0;
    protected $text;

    /**
     * Words constructor.
     *
     * @param SetContract $set
     * @param Text $text
     */
    public function __construct(SetContract $set, Text $text)
    {
        $this->dataSet = $set;
        $this->text    = $text;
    }

    /**
     * Finds bad words from *Set and setting score/replace
     */
    public function processWords() : void
    {
        // to match lower case letters in words set array
        $lowerSource = $this->addLowSpaces($this->text->getString());
        /**
         * @var string $points
         * @var array $words
         */
        foreach ($this->dataSet->getWords() as $points => $words) {
            foreach ($words as $word) {
                if (mb_strpos($lowerSource, ' ' . $word . ' ') !== false) {
                    $this->score += (float)$points;
                    if ($this->text->isReplaceable()) {
                        $this->replace($word);
                    }
                }
            }
        }
        if ($this->score >= self::MAX_SCORE) {
            $this->score = self::MAX_SCORE;
        }
    }

    /**
     * Finds bad words with asterisks and setting score/replace
     */
    public function processPatterns() : void
    {
        $lowerSource = $this->addLowSpaces($this->text->getString());
        if (preg_match_all('/\s(([\w]+)[\*]+([\w]+))\s/', $lowerSource, $matches) > 0) {
            $this->score += (self::ASTERISKS_MIDDLE * count($matches[0]));
            if ($this->text->isReplaceable()) {
                $this->replaceMatches($matches);
            }
        }
        $lowerSource = $this->addLowSpaces($this->text->getString());
        if (preg_match_all('/\s(([\w]+)[\*]+)\s/', $lowerSource, $matches) > 0) {
            $this->score += (self::ASTERISKS_RIGHT * count($matches[0]));
            if ($this->text->isReplaceable()) {
                $this->replaceMatches($matches);
            }
        }
        $lowerSource = $this->addLowSpaces($this->text->getString());
        if (preg_match_all('/\s([\*]+([\w]+))\s/', $lowerSource, $matches) > 0) {
            $this->score += (self::ASTERISKS_LEFT * count($matches[0]));
            if ($this->text->isReplaceable()) {
                $this->replaceMatches($matches);
            }
        }
    }

    /**
     * @param SetContract $set
     */
    public function setData(SetContract $set) : void
    {
        $this->dataSet = $set;
    }

    /**
     * @return float
     */
    public function getScore() : float
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore(float $score) : void
    {
        $this->score = $score;
    }

    /**
     * @param string $str
     * @return string
     */
    protected function addLowSpaces(string $str) : string
    {
        return ' ' . mb_strtolower($str) . ' ';
    }

    /**
     * @param string $phrase word or phrase to replace
     */
    protected function replace(string $phrase) : void
    {
        // todo: slice the word with replacement to prevent WoRd -> word transformations
        $this->text->setString(str_replace($phrase, $this->text->getPrefix() . $this->text->getReplaceChars() . $this->text->getPostfix(),
            mb_strtolower($this->text->getString())));
    }

    private function replaceMatches(array $matches) : void
    {
        /** @var array $matches */
        foreach ($matches[0] as $word) {
            $this->replace($word);
        }
    }

    /**
     * Setter for convenient DI with Text object and it's properties
     * @param Text $text
     */
    public function setText(Text $text) : void
    {
        $this->text = $text;
    }

    /**
     * @return Text
     */
    public function getText() : Text
    {
        return $this->text;
    }

    /**
     * @return SetContract
     */
    public function getDataSet() : SetContract
    {
        return $this->dataSet;
    }

    /**
     * @param SetContract $dataSet
     */
    public function setDataSet(SetContract $dataSet) : void
    {
        $this->dataSet = $dataSet;
    }
}