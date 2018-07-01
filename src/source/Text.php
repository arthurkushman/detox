<?php

namespace detox\source;

class Text
{
    private $text;
    private $replaceChars  = '-----';
    private $prefix        = ' _';
    private $postfix       = '_ ';
    private $isReplaceable = false;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function setString(string $text) : void
    {
        $this->text = $text;
    }

    public function getString() : string
    {
        return $this->text;
    }

    /**
     * @param mixed $replaceChars
     */
    public function setReplaceChars(string $replaceChars) : void
    {
        $this->replaceChars = $replaceChars;
    }

    /**
     * @return mixed
     */
    public function getReplaceChars() : string
    {
        return $this->replaceChars;
    }

    /**
     * @param mixed $prefix
     */
    public function setPrefix($prefix) : void
    {
        $this->prefix = $prefix;
    }

    /**
     * @return mixed
     */
    public function getPostfix()
    {
        return $this->postfix;
    }

    /**
     * @param mixed $postfix
     */
    public function setPostfix($postfix) : void
    {
        $this->postfix = $postfix;
    }

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return mixed
     */
    public function isReplaceable() : bool
    {
        return $this->isReplaceable;
    }

    /**
     * @param mixed $isReplaceable
     */
    public function setReplaceable(bool $isReplaceable) : void
    {
        $this->isReplaceable = $isReplaceable;
    }
}