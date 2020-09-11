# Laravel Bible
[![CircleCI](https://circleci.com/gh/djunehor/laravel-bible.svg?style=svg)](https://circleci.com/gh/djunehor/laravel-bible)
[![Latest Stable Version](https://poser.pugx.org/djunehor/laravel-bible/v/stable)](https://packagist.org/packages/djunehor/laravel-bible)
[![Total Downloads](https://poser.pugx.org/djunehor/laravel-bible/downloads)](https://packagist.org/packages/djunehor/laravel-bible)
[![License](https://poser.pugx.org/djunehor/laravel-bible/license)](https://packagist.org/packages/djunehor/laravel-bible)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/djunehor/laravel-bible/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/djunehor/laravel-bible/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/djunehor/laravel-bible/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Maintainability](https://api.codeclimate.com/v1/badges/9d6be7b057103cb14410/maintainability)](https://codeclimate.com/github/djunehor/laravel-bible/maintainability)
[![StyleCI](https://github.styleci.io/repos/223423445/shield?branch=master)](https://github.styleci.io/repos/223423445)
[![Code Coverage](https://scrutinizer-ci.com/g/djunehor/laravel-bible/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/djunehor/laravel-bible/?branch=master)

Laravel Bible helps you fetch from the Holy Bible

- [Laravel Bible](#laravel-bible)
    - [Installation](#installation)
        - [Laravel 5.5 and above](#laravel-55-and-above)
        - [Laravel 5.4 and older](#laravel-54-and-older)
        - [Lumen](#lumen)
    - [Usage](#usage)
    - [Currently Supported Languages and Versions](#currently-supported-languages-and-versions)
    - [Add New Language and/or Bible Version](#add-new-language-and-bible-version)
    - [Contributing](#contributing)
    - [Acknowledgement](#acknowledgement)

## Installation
You can install the package via composer:

```shell
composer require djunehor/laravel-bible
```

#### Laravel 5.5 and above

The package will automatically register itself, so you can start using it immediately.

#### Laravel 5.4 and older

In Laravel version 5.4 and older, you have to add the service provider in `config/app.php` file manually:

```php
'providers' => [
    // ...
    Djunehor\Logos\BibleServiceProvider::class,
];
```
#### Lumen

After installing the package, you will have to register it in `bootstrap/app.php` file manually:
```php
// Register Service Providers
    // ...
    $app->register(Djunehor\Logos\BibleServiceProvider::class);
];
```

## Usage
```php
use Djunehor\Logos\Bible;

$bible = new Bible();
```

### Get the Book of John
```php
$bible->book('John');
$john = $bible->getBook();

```

### Get All Verses in Matthew Chapter 3
```php
$bible->book('Matthew');
$bible->chapter(3);
$verses = $bible->getChapter();

```

### Get the Book of Mark, Chapter 3, Verse 12
```php
$bible->book('Mark');
$bible->chapter(3);
$bible->verse(12);
$verse = $bible->getVerse();

```

### Using shortcut
```php
// get Genesis 22:6
$verse = $bible->get('Genesis 22:6');
```

### Options
```php
// Bible Class accepts 2 parameters: $lang and $version
$lang = 'en';

$bible = new Bible('en'); // use English version
$bible = new Bible('en', 'kjv'); // use English KJV bible
```

### Using Facade
In order to use the Bible facade:
- First add `'Bible' => Djunehor\Logos\Facades\BibleFacade::class,` to aliases in `config/app.php`
- Then use like `Bible::get('John 3:16');`

### Using Helper
The package ships with a `bible()` method
```php
bible('John 3:16');
```

### Dynamically setting language and/or version
```php
$bible = new Bible(); // lang is set to "en", and version is set to "kjv" by default;
$bible->lang('yo'); // Set language as Yoruba
$bible->version('amp'); // Set version to Amplified Version
```

## Currently Supported Languages and Versions
|Language|Code|Versions|
|:--------- | :-----------------: | :------: |
|English|en|kjv|

### Add new language and bible version
Simply follow the structure of the `bibles/en` folder

## Contributing
- Fork this project
- Clone to your repo
- Make your changes and run tests `composer test`
- Push and create a pull request

## Acknowledgement
- The KJV English bible JSON file was sourced from [here](https://github.com/aruljohn/Bible-kjv)
