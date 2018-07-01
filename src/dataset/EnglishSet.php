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
            'honkey',
            'nigger',
            'flikker',
            // porn industry
            'bukakke',
            'dildo',
            'strapon',
            'shag',
        ],
        '0.9' => ['ugly', 'stupid', 'dumb', 'boobs', 'pish', 'fanny', 'slag', 'squirt'],
        '0.8' => ['silly', 'tits', 'pussy', 'sick', 'git', 'ass', 'poop'],
        '0.7' => ['shallow', 'foolish', 'nonce', 'bugger'],
        '0.6' => ['rednack', 'mindless', 'fat', 'nude', 'wft', 'snot'],
        '0.5' => ['bully', 'sneaky', 'greedy', 'creep'],
        '0.4' => ['superficial', 'numb', 'clown', 'villager'],
        '0.3' => ['fake', 'strange', 'ignorant', 'critical', 'nuts', 'cum', 'come'],
        '0.2' => ['useless', 'thoughtless', 'crazy', 'bollocks'],
        '0.1' => ['dude', 'pal', 'yo'],
    ];

    private $phrases = [
        '1.0' => ['dirty sanchez', 'gang bang', 'piss off'],
        '0.9' => ['swinger party', 'bloody hell', 'bugger off'],
        '0.8' => ['get staffed', 'get lost'],
        '0.7' => ['screw you', 'screw u'],
        '0.3' => ['white supremacy', 'black supremacy', 'ku klux klan', 'black people', 'white people'],
    ];

    /**
     * @return array
     */
    public function getWords() : array
    {
        return $this->words;
    }

    public function getPhrases() : array
    {
        return $this->phrases;
    }
}