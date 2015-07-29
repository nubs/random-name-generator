<?php
namespace Nubs\RandomNameGenerator;

use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \Nubs\RandomNameGenerator\Alliteration
 */
class AlliterationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Verify basic behavior of getName().
     *
     * @test
     * @covers ::getName
     *
     * @return void
     */
    public function getNameBasic()
    {
        $generator = new Alliteration();
        $parts = explode(' ', $generator->getName());
        $this->assertSame(2, count($parts));
        $this->assertSame($parts[0][0], $parts[1][0]);
    }
}
