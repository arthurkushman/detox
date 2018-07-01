## Detox is a library to detect toxic comments of variable length with different patterns

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
    // change text in Text object
    $text->setText('Another text');
    // inject Text object to Phrases 
    $detox->setText($text);
    $detox->processPhrases();
    $text->setText('Yet another text');
    $detox->setText($text);
    $detox->processPatterns();
    if ($detox->getScore() >= 0.5) {
        echo 'Toxic text detected';
    }
```

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