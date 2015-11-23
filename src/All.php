<?php
namespace Nubs\RandomNameGenerator;

use Cinam\Randomizer\Randomizer;

/**
 * A generator that uses all of the other generators randomly.
 */
class All implements Generator
{
    /** @type array The other generators to use. */
    protected $_generators;

    /** @type Cinam\Randomizer\Randomizer The random number generator. */
    protected $_randomizer;

    /**
     * Initializes the All Generator with the default generator list.
     *
     * @api
     * @param array $generators The random generators to use.
     * @param \Cinam\Randomizer\Randomizer $randomizer The random number generator.
     */
    public function __construct(array $generators = [], Randomizer $randomizer = null)
    {
        $this->_generators = empty($generators) ? ['\Nubs\RandomNameGenerator\Alliteration', '\Nubs\RandomNameGenerator\Vgng'] : $generators;
        $this->_randomizer = $randomizer;
    }

    /**
     * Gets a randomly generated name using the configured generators.
     *
     * @api
     * @return string A random name.
     */
    public function getName()
    {
        return $this->_getRandomGenerator()->getName();
    }

    /**
     * Get a random generator from the list of generators.
     *
     * @return \Nubs\RandomNameGenerator\Generator A random generator.
     */
    protected function _getRandomGenerator()
    {
        $generator = $this->_randomizer ?
            $this->_randomizer->getArrayValue($this->_generators) :
            $this->_generators[array_rand($this->_generators)];

        return new $generator($this->_randomizer);
    }
}
