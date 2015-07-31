# Random Name Generator
A PHP library to create interesting, sometimes entertaining, random names.

[![Build Status](http://img.shields.io/travis/nubs/random-name-generator.svg?style=flat)](https://travis-ci.org/nubs/random-name-generator)
[![Scrutinizer Code Quality](http://img.shields.io/scrutinizer/g/nubs/random-name-generator.svg?style=flat)](https://scrutinizer-ci.com/g/nubs/random-name-generator/)
[![Coverage Status](https://coveralls.io/repos/nubs/random-name-generator/badge.svg?branch=master&service=github)](https://coveralls.io/github/nubs/random-name-generator?branch=master)

[![Latest Stable Version](http://img.shields.io/packagist/v/nubs/random-name-generator.svg?style=flat)](https://packagist.org/packages/nubs/random-name-generator)
[![Total Downloads](http://img.shields.io/packagist/dt/nubs/random-name-generator.svg?style=flat)](https://packagist.org/packages/nubs/random-name-generator)
[![License](http://img.shields.io/packagist/l/nubs/random-name-generator.svg?style=flat)](https://packagist.org/packages/nubs/random-name-generator)

[![Dependency Status](https://www.versioneye.com/user/projects/537d561814c15855aa000019/badge.svg?style=flat)](https://www.versioneye.com/user/projects/537d561814c15855aa000019)

## Requirements
This library requires PHP 5.4, or newer.

## Installation
This package uses [composer](https://getcomposer.org) so you can just add
`nubs/random-name-generator` as a dependency to your `composer.json` file or
execute the following command:

```bash
composer require nubs/random-name-generator
```

## Generators

### Video Game Names
The video game name generator is based off of [prior](http://videogamena.me/) [art](https://github.com/nullpuppy/vgng).  It will generate unique names based off of "typical" video games.

#### Examples
* *Kamikaze Bubblegum Warrior*
* *Rockin' Valkyrie Gaiden*
* *Neurotic Jackhammer Detective*
* *My Little Mountain Climber Conflict*
* *Small-Time Princess vs. The Space Mutants*

#### Usage
```php
$generator = new \Nubs\RandomNameGenerator\Vgng();
echo $generator->getName();
```

## Alliterative Names
The alliteration name generator is based off of a list of [adjectives](http://grammar.yourdictionary.com/parts-of-speech/adjectives/list-of-adjective-words.html) and a list of [animals](https://animalcorner.co.uk/animals/).

#### Examples
* *Agreeable Anaconda*
* *Disturbed Duck*
* *Misty Meerkat*
* *Prickly Pig*

#### Usage
```php
$generator = new \Nubs\RandomNameGenerator\Alliteration();
echo $generator->getName();
```
