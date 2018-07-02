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
            'arse',
            'arsehole',
            'tosser',
            'wanker',
            'bastard',
            'honkey',
            'nigger',
            'flikker',
            'scumbag',
            // porn industry
            'bukakke',
            'dildo',
            'strapon',
            'shag',
            'sex',
            'blowjob',
            'bdsm',
            'bbd',
            'milf',
            'anal',
            'vagina',
        ],
        '0.9' => ['ugly', 'stupid', 'dumb', 'boobs', 'pish', 'fanny', 'slag', 'squirt', 'torture', 'ass', 'nitwit', 'whiffet'],
        '0.8' => ['silly', 'tits', 'pussy', 'sick', 'git', 'poop', 'slaughter'],
        '0.7' => ['shallow', 'foolish', 'nonce', 'bugger', 'naught', 'prick', 'schmuck', 'nonentity'],
        '0.6' => ['rednack', 'mindless', 'fat', 'nude', 'wft', 'snot', 'bloodbath', 'massacre', 'massacrer'],
        '0.5' => ['bully', 'sneaky', 'greedy', 'creep', 'kill', 'revenge', 'catfight', 'die', 'death', 'nought', 'nonentity'],
        '0.4' => ['superficial', 'numb', 'clown', 'villager', 'flatter', 'murder', 'nothingness'],
        '0.3' => ['fake', 'strange', 'ignorant', 'critical', 'nuts', 'cum', 'genitals', 'retaliation', 'freak'],
        '0.2' => ['useless', 'thoughtless', 'crazy', 'bollocks', 'bit', 'hit', 'exterminate'],
        '0.1' => ['dude', 'pal', 'yo', 'punch', 'insect', 'annihilate'],
    ];

    private $phrases = [
        '1.0' => ['dirty sanchez', 'gang bang', 'piss off', 'blow job'],
        '0.9' => ['swinger party', 'bloody hell', 'bugger off', 'black on white', 'double penetration'],
        '0.8' => ['get staffed', 'get lost'],
        '0.7' => ['screw you', 'screw u', 'get off'],
        '0.3' => ['white supremacy', 'black supremacy', 'ku klux klan'],
        '0.2' => [
            'black people',
            'white people',
            'asian people',
            'indian people',
            'spanish people',
            'mexican people',
            'black ppl',
            'white ppl',
            'asian ppl',
            'indian ppl',
            'spanish ppl',
            'mexican ppl',
        ],
    ];

    /**
     * @return array
     */
    public function getWords() : array
    {
        return $this->words;
    }

    /**
     * @return array
     */
    public function getPhrases() : array
    {
        return $this->phrases;
    }
}