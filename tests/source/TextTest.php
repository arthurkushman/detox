<?php

namespace detoxtests\source;


use detox\source\Text;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

/**
 * Class TextTest
 * @package detoxtests\source
 *
 * @property Text text
 */
class TextTest extends TestCase
{
    private $text;
    private $faker;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->text = new Text('');
    }

    /**
     * @test
     */
    public function it_checks_text()
    {
        $this->assertEmpty($this->text->getText());
        $str = $this->faker->title;
        $this->text->setText($str);
        $this->assertEquals($str, $this->text->getText());
    }

    /**
     * @test
     */
    public function it_checks_replaces()
    {
        $this->text->setReplaceChars('___');
        $this->assertEquals('___', $this->text->getReplaceChars());
        $this->text->setPrefix('pre');
        $this->assertEquals('pre', $this->text->getPrefix());
        $this->text->setPostfix('post');
        $this->assertEquals('post', $this->text->getPostfix());
    }
}