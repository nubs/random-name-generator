<?php
namespace Nubs\RandomNameGenerator;

abstract class AbstractGenerator implements Generator
{
    /**
     * Alias for getName so that the generator can be directly stringified.
     *
     * Note that this will return a different name everytime it is cast to a
     * string.
     *
     * @api
     * @return string A random name.
     */
    public function __toString()
    {
        return $this->getName();
    }
}
