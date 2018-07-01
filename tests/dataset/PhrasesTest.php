<?php

namespace detoxtests\dataset;


use detox\core\Phrases;
use detox\dataset\CustomSet;
use detox\dataset\EnglishSet;
use detox\source\Text;
use PHPUnit\Framework\TestCase;

/**
 * Class WordsTest
 *
 * @package detoxtests\dataset
 *
 * @property Phrases phrases
 * @property Text text
 */
class PhrasesTest extends TestCase
{
    private $set;
    private $phrases;
    private $text;

    public function setUp()
    {
        parent::setUp();
        $this->set     = new EnglishSet();
        $this->text    = new Text('');
        $this->phrases = new Phrases($this->set, $this->text);
    }

    /**
     * @test
     */
    public function it_checks_phrases_on_score()
    {
        // 1.0 level
        $this->text->setString('Just piss off');
        $this->phrases->setText($this->text);
        $this->phrases->processPhrases();
        $this->assertEquals(1, $this->phrases->getScore());
        // 0.9 level
        $this->phrases->setScore(0);
        $this->text->setString('It was like bloody hell dude');
        $this->phrases->setText($this->text);
        $this->phrases->processPhrases();
        $this->assertEquals(0.9, $this->phrases->getScore());
        // 0.8 level
        $this->phrases->setScore(0);
        $this->text->setString('I`d like you to get lost forever');
        $this->phrases->setText($this->text);
        $this->phrases->processPhrases();
        $this->assertEquals(0.8, $this->phrases->getScore());
        // test composition of phrases
        $this->phrases->setScore(0);
        $this->text->setString('I`d like you to get lost forever, because this turns into bloody hell');
        $this->phrases->setText($this->text);
        $this->phrases->processPhrases();
        $this->assertEquals(1, $this->phrases->getScore());
    }

    /**
     * @test
     */
    public function it_replaces_phrases()
    {
        $this->text->setPrefix('pre');
        $this->text->setPostfix('post');
        $this->text->setReplaceChars('____');
        $this->text->setString('Just piss off dude');
        $this->text->setReplaceable(true);
        $this->phrases->setText($this->text);

        $this->phrases->processPhrases();
        $this->assertEquals('just pre____post dude', $this->phrases->getText()->getString());
    }

    /**
     * @test
     */
    public function it_sets_custom_dict()
    {
        $customSet = new CustomSet();
        $customSet->setPhrases([
            '0.8' => ['weird phrase']
        ]);
        $this->text->setString('This weird phrase text should be detected');
        $this->phrases->setText($this->text);
        $this->phrases->setDataSet($customSet);
        $this->phrases->processPhrases();
        $this->assertEquals(0.8, $this->phrases->getScore());
    }
}