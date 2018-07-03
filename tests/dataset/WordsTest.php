<?php

namespace detoxtests\dataset;


use detox\core\Words;
use detox\dataset\CustomSet;
use detox\dataset\EnglishSet;
use detox\exceptions\BadDictException;
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
        $this->text->setString('Fuck you bitch');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(1, $this->words->getScore());
        // 0.9 level
        $this->words->setScore(0);
        $this->text->setString('She is so stupid');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.9, $this->words->getScore());
        // 0.8 level
        $this->words->setScore(0);
        $this->text->setString('There was a slaughter, they told me');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.8, $this->words->getScore());
        // 0.7 level
        $this->words->setScore(0);
        $this->text->setString('She has tits');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.7, $this->words->getScore());
        // 0.6 level
        $this->words->setScore(0);
        $this->text->setString('Fat and uninteresting');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.6, $this->words->getScore());
        // 0.5 level
        $this->words->setScore(0);
        $this->text->setString('He`s kinda sneaky');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.5, $this->words->getScore());
        // 0.4 level
        $this->words->setScore(0);
        $this->text->setString('You r looking like a clown');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.4, $this->words->getScore());
        // 0.3 level
        $this->words->setScore(0);
        $this->text->setString('This drives me nuts and ashamed');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.3, $this->words->getScore());
        // 0.2 level
        $this->words->setScore(0);
        $this->text->setString('She looks thoughtless when acting like that');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.2, $this->words->getScore());
        // 0.1 level and lower/noisier
        $this->words->setScore(0);
        $this->text->setString('Dude why are you saying so');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(0.06, $this->words->getScore());
    }

    /**
     * @test
     */
    public function it_checks_multiple_words_on_score()
    {
        $this->text->setString('She is so foolish and thoughtless');
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
        $this->text->setString('f***k that was hilarious');
        $this->words->setText($this->text);
        $this->words->processPatterns();
        $this->assertEquals(0.8, $this->words->getScore());
        // 0.6 level for right asterisks
        $this->words->setScore(0);
        $this->text->setString('f*** you');
        $this->words->setText($this->text);
        $this->words->processPatterns();
        $this->assertEquals(0.6, $this->words->getScore());
        // 0.5 level for right asterisks
        $this->words->setScore(0);
        $this->text->setString('***k you');
        $this->words->setText($this->text);
        $this->words->processPatterns();
        $this->assertEquals(0.5, $this->words->getScore());
    }

    /**
     * @test
     */
    public function it_checks_multiple_patterns_on_score()
    {
        $this->text->setString('This is f***k as hell and that b**ch thought that was normal');
        $this->text->setReplaceable(true);
        $this->words->setText($this->text);
        $this->words->processPatterns();
        $this->assertEquals(1.6, $this->words->getScore());
        $this->assertEquals('this is _-----_ as hell and that _-----_ thought that was normal', $this->words->getText()->getString());
    }

    /**
     * @test
     */
    public function it_replaces_words()
    {
        $this->text->setPrefix('pre');
        $this->text->setPostfix('post');
        $this->text->setReplaceChars('____');
        $this->text->setString('Fuck you bitch');
        $this->text->setReplaceable(true);
        $this->words->setText($this->text);

        $this->words->processWords();
        $this->assertEquals('pre____post you pre____post', $this->words->getText()->getString());
    }

    /**
     * @test
     */
    public function it_sets_custom_dict()
    {
        $customSet = new CustomSet();
        $customSet->setWords([
            '0.9' => ['weird']
        ]);
        $this->text->setString('This weird text should be detected');
        $this->words->setText($this->text);
        $this->words->setDataSet($customSet);
        $this->words->processWords();
        $this->assertEquals(0.9, $this->words->getScore());
    }

    /**
     * @test
     */
    public function it_checks_mutated_words()
    {
        $this->words->setScore(0);
        $this->text->setString('Dude you look fuckingly cockish in that crappy situation');
        $this->words->setText($this->text);
        $this->words->processWords();
        $this->assertEquals(1.0, $this->words->getScore());
    }
}