<?php

namespace detoxtests\dataset;


use detox\core\Words;
use detox\dataset\EnglishSet;
use detox\source\Text;
use PHPUnit\Framework\TestCase;

/**
 * Class WordsTest
 *
 * @package detoxtests\dataset
 *
 * @property Words words
 * @property Text text
 */
class WordsTest extends TestCase
{
    private $set;
    private $words;
    private $text;

    public function setUp()
    {
        parent::setUp();
        $this->set   = new EnglishSet();
        $this->text  = new Text('');
        $this->words = new Words($this->set, $this->text);
    }

    /**
     * @test
     */
    public function it_checks_words_on_score()
    {
        // to test setter for data
        $this->words->setData(new EnglishSet());
        // 1.0 level
        $this->text->setText('Fuck you bitch');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(1, $this->words->getScore());
        // 0.9 level
        $this->words->setScore(0);
        $this->text->setText('She is so stupid');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.9, $this->words->getScore());
        // 0.8 level
        $this->words->setScore(0);
        $this->text->setText('She has tits');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.8, $this->words->getScore());
        // 0.7 level
        $this->words->setScore(0);
        $this->text->setText('She is so foolish');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.7, $this->words->getScore());
        // 0.6 level
        $this->words->setScore(0);
        $this->text->setText('Fat and uninteresting');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.6, $this->words->getScore());
        // 0.5 level
        $this->words->setScore(0);
        $this->text->setText('He`s kinda sneaky');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.5, $this->words->getScore());
        // 0.4 level
        $this->words->setScore(0);
        $this->text->setText('You r looking like a clown');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.4, $this->words->getScore());
        // 0.3 level
        $this->words->setScore(0);
        $this->text->setText('This drives me nuts and ashamed');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.3, $this->words->getScore());
        // 0.2 level
        $this->words->setScore(0);
        $this->text->setText('She looks thoughtless when acting like that');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.2, $this->words->getScore());
        // 0.1 level
        $this->words->setScore(0);
        $this->text->setText('Dude why are you saying so');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.1, $this->words->getScore());
    }

    /**
     * @test
     */
    public function it_checks_multiple_words_on_score()
    {
        $this->text->setText('She is so foolish and thoughtless');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.9, $this->words->getScore());
    }

    /**
     * @test
     */
    public function it_checks_patterns_on_score()
    {
        // 0.8 level for middle asterisks
        $this->text->setText('f***k that was hilarious');
        $this->words->setText($this->text);
        $this->words->processPatterns();
        $this->assertEquals(0.8, $this->words->getScore());
        // 0.6 level for right asterisks
        $this->words->setScore(0);
        $this->text->setText('f*** you');
        $this->words->setText($this->text);
        $this->words->processPatterns();
        $this->assertEquals(0.6, $this->words->getScore());
        // 0.5 level for right asterisks
        $this->words->setScore(0);
        $this->text->setText('***k you');
        $this->words->setText($this->text);
        $this->words->processPatterns();
        $this->assertEquals(0.5, $this->words->getScore());
    }

    /**
     * @test
     */
    public function it_checks_multiple_patterns_on_score()
    {
        $this->text->setText('This is f***k as hell and that b**ch thought that was normal');
        $this->words->setText($this->text);
        $this->words->processPatterns();
        $this->assertEquals(0.8, $this->words->getScore());
    }
}