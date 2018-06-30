## Detox is a library to detect toxic comments of variable length with different patterns

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/arthurkushman/detox/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/arthurkushman/detox/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/arthurkushman/detox/badges/build.png?b=master)](https://scrutinizer-ci.com/g/arthurkushman/detox/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/arthurkushman/detox/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![codecov](https://codecov.io/gh/arthurkushman/detox/branch/master/graph/badge.svg)](https://codecov.io/gh/arthurkushman/detox)

### Using words and word patterns
To get toxicity score on any text:
```php
    $words = new Words(new EnglishSet());
    $words->processWords($text);
    if ($words->getScore() >= 0.5) {
        echo 'Toxic text detected';
    }
```
to test an input string on asterisk pattern occurrences:
```php
    $words->processPatterns($text);
    if ($words->getScore() >= 0.5) {
        echo 'Toxic text detected';
    }    
```

### Using phrases 
Another option is to check for phrases:
```php
    $phrases = new Phrases(new EnglishSet());
    $phrases->processPhrases($text);
    if ($words->getScore() >= 0.5) {
        echo 'Toxic text detected';
    }
```

There are no constraints to use all options at once, so u can do the following:
```php
    // Phrases object extends Words - just use all inherited methods 
    $detox = new Phrases(new EnglishSet());
    $detox->processWords($text);
    $detox->processPhrases($text);
    $detox->processPatterns($text);
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