<?php

namespace detox\core;


use detox\dataset\SetContract;

class Words
{

    public const MAX_SCORE        = 1;
    public const ASTERISKS_MIDDLE = 0.5;
    public const ASTERISKS_LEFT   = 0.2;
    public const ASTERISKS_RIGHT  = 0.3;

    private $dataSet;
    private $score;

    private $words = [];

    /**
     * Words constructor.
     *
     * @param SetContract $set
     */
    public function __construct(SetContract $set)
    {
        $this->dataSet = $set;
    }

    /**
     * @param string $source
     */
    public function processWords(string $source): void
    {
        // to match lower case letters in words set array
        $lowerSource = ' ' . mb_strtolower($source) . ' ';
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
                    // we don't need to iterate more
                    return;
                }
            }
        }
    }

    /**
     * @param string $source
     */
    public function processPatterns(string $source): void
    {
        $this->setWords($source);
        foreach ($this->words as $word) {
            if (preg_match('/\w(\*+)\w/', $word) === 1) {
                $this->score += self::ASTERISKS_MIDDLE;
            } else if (preg_match('/\w(\*+)/', $word) === 1) {
                $this->score += self::ASTERISKS_LEFT;
            } else if (preg_match('/(\*+)\w/', $word) === 1) {
                $this->score += self::ASTERISKS_RIGHT;
            }
        }
    }

    /**
     * @param string $source
     */
    public function setWords(string $source): void
    {
        $this->words = str_word_count($source, 1);
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore(float $score): void
    {
        $this->score = $score;
    }
}