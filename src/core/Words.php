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
        $lowerSource = $this->addLowSpaces($this->text->getText());
        /**
         * @var string $points
         * @var array $words
         */
        foreach ($this->dataSet->getWords() as $points => $words) {
            foreach ($words as $word) {
                if (mb_strpos($lowerSource, ' ' . $word . ' ') !== false) {
                    $this->score += (float)$points;
                }
                if ($this->score >= self::MAX_SCORE) {
                    $this->score = self::MAX_SCORE;

                    // we don't need to iterate more with max score
                    return;
                }
            }
        }
    }

    /**
     * Finds bad words with asterisks and setting score/replace
     */
    public function processPatterns() : void
    {
        $lowerSource = $this->addLowSpaces($this->text->getText());
        if (preg_match('/\s(([\w]+)[\*]+([\w]+))\s/', $lowerSource) === 1) {
            $this->score += self::ASTERISKS_MIDDLE;
        } else if (preg_match('/\s(([\w]+)[\*]+)/', $lowerSource) === 1) {
            $this->score += self::ASTERISKS_RIGHT;
        } else if (preg_match('/([\*]+([\w]+))\s/', $lowerSource) === 1) {
            $this->score += self::ASTERISKS_LEFT;
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
}