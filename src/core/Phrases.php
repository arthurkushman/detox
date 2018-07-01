<?php

namespace detox\core;

class Phrases extends Words
{
    /**
     * Finds phrases from *Set and sets score/replacements
     */
    public function processPhrases()
    {
        // to match lower case letters in words set array
        $lowerSource = $this->addLowSpaces($this->text->getString());
        /**
         * @var string $points
         * @var array $phrases
         */
        foreach ($this->dataSet->getPhrases() as $points => $phrases) {
            foreach ($phrases as $phrase) {
                if (mb_strpos($lowerSource, ' ' . $phrase . ' ') !== false) {
                    $this->score += (float)$points;
                    if ($this->text->isReplaceable()) {
                        $this->replace($phrase);
                    }
                }
            }
        }
        if ($this->score >= self::MAX_SCORE) {
            $this->score = self::MAX_SCORE;
        }
    }
}