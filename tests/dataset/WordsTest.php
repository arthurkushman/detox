<?php

namespace detoxtests\dataset;


use detox\core\Words;
use detox\dataset\EnglishSet;
use PHPUnit\Framework\TestCase;

/**
 * Class WordsTest
 *
 * @package detoxtests\dataset
 *
 * @property Words words
 */
class WordsTest extends TestCase
{
    private $set;
    private $words;

    public function setUp()
    {
        parent::setUp();
        $this->set   = new EnglishSet();
        $this->words = new Words($this->set);
    }

    /**
     * @test
     */
    public function it_checks_words_on_score()
    {
        // 1.0 level
        $src = 'Fuck you bitch';
        $this->words->processWords($src);
        $this->assertEquals(1, $this->words->getScore());
        // 0.9 level
        $this->words->setScore(0);
        $src = 'She is so stupid';
        $this->words->processWords($src);
        $this->assertEquals(0.9, $this->words->getScore());
        // 0.8 level
        $this->words->setScore(0);
        $src = 'She has tits';
        $this->words->processWords($src);
        $this->assertEquals(0.8, $this->words->getScore());
        // 0.7 level
        $this->words->setScore(0);
        $src = 'She is so foolish';
        $this->words->processWords($src);
        $this->assertEquals(0.7, $this->words->getScore());
        // 0.6 level
        $this->words->setScore(0);
        $src = 'Fat and uninteresting';
        $this->words->processWords($src);
        $this->assertEquals(0.6, $this->words->getScore());
        // 0.5 level
        $this->words->setScore(0);
        $src = 'He`s kinda sneaky';
        $this->words->processWords($src);
        $this->assertEquals(0.5, $this->words->getScore());
        // 0.4 level
        $this->words->setScore(0);
        $src = 'You r looking like a clown';
        $this->words->processWords($src);
        $this->assertEquals(0.4, $this->words->getScore());
        // 0.3 level
        $this->words->setScore(0);
        $src = 'This drives me nuts and ashamed';
        $this->words->processWords($src);
        $this->assertEquals(0.3, $this->words->getScore());
        // 0.2 level
        $this->words->setScore(0);
        $src = 'She looks thoughtless when acting like that';
        $this->words->processWords($src);
        $this->assertEquals(0.2, $this->words->getScore());
        // 0.1 level
        $this->words->setScore(0);
        $src = 'Dude why are you saying so';
        $this->words->processWords($src);
        $this->assertEquals(0.1, $this->words->getScore());
    }

    /**
     * @test
     */
    public function it_checks_multiple_words_on_score()
    {
        $src = 'She is so foolish and thoughtless';
        $this->words->processWords($src);
        $this->assertEquals(0.9, $this->words->getScore());
    }

    /**
     * @test
     */
    public function it_checks_patterns_on_score()
    {
        // 0.8 level for middle asterisks
        $src = 'f***k that was hilarious';
        $this->words->processPatterns($src);
        $this->assertEquals(0.8, $this->words->getScore());
        // 0.6 level for right asterisks
        $this->words->setScore(0);
        $src = 'f*** you';
        $this->words->processPatterns($src);
        $this->assertEquals(0.6, $this->words->getScore());
        // 0.5 level for right asterisks
        $this->words->setScore(0);
        $src = '***k you';
        $this->words->processPatterns($src);
        $this->assertEquals(0.5, $this->words->getScore());
    }

    /**
     * @test
     */
    public function it_checks_multiple_patterns_on_score()
    {
        $src = 'This is f***k as hell and that b**ch thought that was normal';
        $this->words->processPatterns($src);
        $this->assertEquals(0.8, $this->words->getScore());
    }
}