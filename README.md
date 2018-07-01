## Detox is a library to detect toxic comments/posts of variable length with different patterns

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/arthurkushman/detox/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/arthurkushman/detox/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/arthurkushman/detox/badges/build.png?b=master)](https://scrutinizer-ci.com/g/arthurkushman/detox/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/arthurkushman/detox/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![codecov](https://codecov.io/gh/arthurkushman/detox/branch/master/graph/badge.svg)](https://codecov.io/gh/arthurkushman/detox)

It's inspired by providing tool for simple scoring/filtering with just a PHP implementation (without the need to set multiple libs probably on C/Python, or importing db dumps etc).   

### Installation

```php
composer require arthurkushman/detox
```

### Using words and word patterns
To get toxicity score on any text:
```php
    $text  = new Text('Some text');   
    $words = new Words(new EnglishSet(), $text);
    $words->processWords();
    if ($words->getScore() >= 0.5) {
        echo 'Toxic text detected';
    }
```
to test an input string on asterisk pattern occurrences:
```php
    $words->processPatterns();
    if ($words->getScore() >= 0.5) {
        echo 'Toxic text detected';
    }    
```

### Using phrases 
Another option is to check for phrases:
```php
    $phrases = new Phrases(new EnglishSet(), $text);
    $phrases->processPhrases();
    if ($words->getScore() >= 0.5) {
        echo 'Toxic text detected';
    }
```

There are no constraints to use all options at once, so u can do the following:
```php
    // Phrases object extends Words - just use all inherited methods 
    $detox = new Phrases(new EnglishSet(), $text);
    $detox->processWords();
    // change string in Text object
    $text->setString('Another text');
    // inject Text object to Phrases 
    $detox->setText($text);
    $detox->processPhrases();
    $text->setString('Yet another text');
    $detox->setText($text);
    $detox->processPatterns();
    if ($detox->getScore() >= 0.5) {
        echo 'Toxic text detected';
    }
```

### Replace with custom templates and prefix/postfix pre-sets
An additional option that u may need in particular situations is to replace words/phrases with pre-set template:
```php
    $this->text->setPrefix('[');
    $this->text->setPostfix(']');
    $this->text->setReplaceChars('____');
    $this->text->setString('Just piss off dude');
    $this->text->setReplaceable(true);
    $this->phrases->setText($this->text);

    $this->phrases->processPhrases();
    echo $this->phrases->getText()->getString(); // output: Just [____] dude 
```
By default pattern is 5 dashes, so u can call only `$this->text->setReplaceable(true);` before any processor to achieve replacement with default settings. 

### Run tests
In root directory (in console) run the following:
```php
phpunit
```
Be sure to install phpunit globally, or run it from vendor:
```php
vendor/bin/phpunit
```

All contributions are welcome