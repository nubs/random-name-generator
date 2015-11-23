<?php
namespace Nubs\RandomNameGenerator;

use Cinam\Randomizer\Randomizer;

/**
 * Defines an alliterative name generator.
 */
class Alliteration implements Generator
{
    /** @type array The definition of the potential adjectives. */
    protected $_adjectives;

    /** @type array The definition of the potential nouns. */
    protected $_nouns;

    /** @type Cinam\Randomizer\Randomizer The random number generator. */
    protected $_randomizer;

    /**
     * Initializes the Alliteration Generator with the default word lists.
     *
     * @api
     * @param \Cinam\Randomizer\Randomizer $randomizer The random number generator.
     */
    public function __construct(Randomizer $randomizer = null)
    {
        $this->_randomizer = $randomizer;
        $this->_adjectives = file(__DIR__ . '/adjectives.txt', FILE_IGNORE_NEW_LINES);
        $this->_nouns = file(__DIR__ . '/nouns.txt', FILE_IGNORE_NEW_LINES);
    }

    /**
     * Gets a randomly generated alliterative name.
     *
     * @api
     * @return string A random alliterative name.
     */
    public function getName()
    {
        $adjective = $this->_getRandomWord($this->_adjectives);
        $noun = $this->_getRandomWord($this->_nouns, $adjective[0]);

        return ucwords("{$adjective} {$noun}");
    }

    /**
     * Get a random word from the list of words, optionally filtering by starting letter.
     *
     * @param array $words An array of words to choose from.
     * @param string $startingLetter The desired starting letter of the word.
     * @return string The random word.
     */
    protected function _getRandomWord(array $words, $startingLetter = null)
    {
        $wordsToSearch = $startingLetter === null ? $words : preg_grep("/^{$startingLetter}/", $words);
        return $this->_randomizer ? $this->_randomizer->getArrayValue($wordsToSearch) : $wordsToSearch[array_rand($wordsToSearch)];
    }
}
