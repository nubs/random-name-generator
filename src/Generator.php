<?php
namespace Nubs\RandomNameGenerator;

/**
 * Defines the standard interface for all the random name generators.
 */
interface Generator
{
    /**
     * Gets a randomly generated name.
     *
     * @api
     * @return string A random name.
     */
    public function getName();
}
