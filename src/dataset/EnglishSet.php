<?php

namespace detox\dataset;


class EnglishSet implements SetContract
{

    private $words = [
        '1.0' => [
            // simple bad words
            'fuck',
            'slut',
            'dick',
            'faggot',
            'bitch',
            'douchebag',
            'dickhead',
            'jerk',
            'cunt',
            'shit',
            'piss',
            'crap',
            'cock',
            'twat',
            'arsehole',
            'tosser',
            'wanker',
            'bastard',
            // porn industry
            'bukakke',
            'dildo',
            'strapon',
        ],
        '0.9' => ['ugly', 'stupid', 'dumb', 'boobs', 'pish', 'fanny', 'slag', 'squirt'],
        '0.8' => ['silly', 'tits', 'pussy', 'sick', 'git', 'ass'],
        '0.7' => ['shallow', 'foolish', 'nonce', 'bugger'],
        '0.6' => ['broken', 'mindless', 'fat', 'nude'],
        '0.5' => ['bully', 'sneaky', 'greedy', 'creep'],
        '0.4' => ['superficial', 'numb', 'clown'],
        '0.3' => ['fake', 'strange', 'ignorant', 'critical', 'nuts', 'cum', 'come'],
        '0.2' => ['useless', 'thoughtless', 'crazy'],
        '0.1' => ['dude', 'pal', 'yo'],
    ];

    private $phrases = [
        '1.0' => ['dirty sanchez', 'gang bang'],
        '0.9' => ['swinger party'],
    ];

    /**
     * @return array
     */
    public function getWords(): array
    {
        return $this->words;
    }

    public function getPhrases(): array
    {
        return $this->words;
    }
}