<?php

namespace detox\dataset;


interface SetContract
{

    public function getWords(): array;

    public function getPhrases(): array;
}