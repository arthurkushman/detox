<?php
/**
 * Created by PhpStorm.
 * User: arthurkushman
 * Date: 30.06.18
 * Time: 13:40
 */

namespace detoxtests\dataset;


use detox\core\Phrases;
use detox\dataset\EnglishSet;
use PHPUnit\Framework\TestCase;

/**
 * Class WordsTest
 *
 * @package detoxtests\dataset
 *
 * @property Phrases phrases
 */
class PhrasesTest extends TestCase
{
    private $set;
    private $phrases;

    public function setUp()
    {
        parent::setUp();
        $this->set   = new EnglishSet();
        $this->phrases = new Phrases($this->set);
    }

    /**
     * @test
     */
    public function it_checks_phrases_on_score()
    {
        // 1.0 level
        $src = 'Just piss off';
        $this->phrases->processPhrases($src);
        $this->assertEquals(1, $this->phrases->getScore());
        // 0.9 level
        $this->phrases->setScore(0);
        $src = 'It was like bloody hell dude';
        $this->phrases->processPhrases($src);
        $this->assertEquals(0.9, $this->phrases->getScore());
        // 0.8 level
        $this->phrases->setScore(0);
        $src = 'I`d like you to get lost forever';
        $this->phrases->processPhrases($src);
        $this->assertEquals(0.8, $this->phrases->getScore());
        // test composition of phrases
        $this->phrases->setScore(0);
        $src = 'I`d like you to get lost forever, because this turns into bloody hell';
        $this->phrases->processPhrases($src);
        $this->assertEquals(1, $this->phrases->getScore());
    }
}