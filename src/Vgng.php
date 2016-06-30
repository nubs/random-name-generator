<?php
namespace Nubs\RandomNameGenerator;

use Cinam\Randomizer\Randomizer;

/**
 * Defines a video game name generator based off of
 * https://github.com/nullpuppy/vgng which in turn is based off of
 * http://videogamena.me/vgng.js.
 */
class Vgng implements Generator
{
    /** @type array The definition of the potential names. */
    protected $_definitionSets;

    /** @type Cinam\Randomizer\Randomizer The random number generator. */
    protected $_randomizer;

    /**
     * Initializes the Video Game Name Generator from the default word list.
     *
     * @api
     * @param \Cinam\Randomizer\Randomizer $randomizer The random number generator.
     */
    public function __construct(Randomizer $randomizer = null)
    {
        $this->_randomizer = $randomizer;
        $this->_definitionSets = array_map(
            [$this, '_parseSection'],
            $this->_getSections($this->_getFileContents())
        );
    }

    /**
     * Gets a randomly generated video game name.
     *
     * @api
     * @return string A random video game name.
     */
    public function getName()
    {
        $similarWords = [];
        $words = [];

        foreach ($this->_definitionSets as $definitionSet) {
            $word = $this->_getUniqueWord($definitionSet, $similarWords);
            $words[] = $word['word'];
            $similarWords[] = $word['word'];
            $similarWords = array_merge($similarWords, $word['similarWords']);
        }

        return implode(' ', $words);
    }

    /**
     * Get a definition from the definitions that does not exist already.
     *
     * @param array $definitions The word list to pick from.
     * @param array $existingWords The already-chosen words to avoid.
     * @return array The definition of a previously unchosen word.
     */
    protected function _getUniqueWord(array $definitions, array $existingWords)
    {
        $definition = $this->_randomizer ? $this->_randomizer->getArrayValue($definitions) : $definitions[array_rand($definitions)];

        if (array_search($definition['word'], $existingWords) === false) {
            return $definition;
        }

        return $this->_getUniqueWord($definitions, $existingWords);
    }

    /**
     * Gets the file contents of the video_game_names.txt file.
     *
     * @return string The video_game_names.txt contents.
     */
    protected function _getFileContents()
    {
        return file_get_contents(__DIR__ . '/video_game_names.txt');
    }

    /**
     * Separates the contents into each of the word list sections.
     *
     * This builder operates by picking a random word from each of a consecutive
     * list of word lists.  These separate lists are separated by a line
     * consisting of four hyphens in the file.
     *
     * @param string $contents The file contents.
     * @return array Each section split into its own string.
     */
    protected function _getSections($contents)
    {
        return array_map('trim', explode('----', $contents));
    }

    /**
     * Parses the given section into the final definitions.
     *
     * @param string $section The newline-separated list of words in a section.
     * @return array The parsed section into its final form.
     */
    protected function _parseSection($section)
    {
        return array_map(
            [$this, '_parseDefinition'],
            $this->_getDefinitionsFromSection($section)
        );
    }

    /**
     * Gets the separate definitions from the given section.
     *
     * @param string $section The newline-separated list of words in a section.
     * @return array Each word split out, but unparsed.
     */
    protected function _getDefinitionsFromSection($section)
    {
        return array_map('trim', explode("\n", $section));
    }

    /**
     * Parses a single definition into its component pieces.
     *
     * The format of a definition in a file is word[^similarWord|...].
     *
     * @param string $definition The definition.
     * @return array The formatted definition.
     */
    protected function _parseDefinition($definition)
    {
        $word = strtok($definition, '^');
        $similarWords = array_filter(explode('|', strtok('^')));

        return ['word' => $word, 'similarWords' => $similarWords];
    }
}
