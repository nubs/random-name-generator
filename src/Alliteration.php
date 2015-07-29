<?php
namespace Nubs\RandomNameGenerator;

/**
 * Defines an alliterative name generator.
 */
class Alliteration implements Generator
{
    /**
     * All adjectives to be used.
     *
     * @var array
     */
    private $adjectives;

    /**
     * All nouns to be used.
     *
     * @var array
     */
    private $nouns;

    /**
     * Create a new instance of Alliteration
     */
    public function __construct()
    {
        $this->adjectives = file(__DIR__ . '/adjectives.txt', FILE_IGNORE_NEW_LINES);
        $this->nouns = file(__DIR__ . '/nouns.txt', FILE_IGNORE_NEW_LINES);
    }

    /**
     * Gets a randomly generated alliterative name.
     *
     * @return string A random alliterative name.
     */
    public function getName()
    {
        // Get a random adjective
        $adjective = $this->adjectives[array_rand($this->adjectives)];

        //Get a random noun based on the first letter of the adjective
        $noun = $this->nouns[array_rand(preg_grep("/^{$adjective[0]}/", $this->nouns))];

        return ucwords("{$adjective} {$noun}");
    }
}
