<?php
namespace Nubs\RandomNameGenerator;

use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \Nubs\RandomNameGenerator\Vgng
 * @covers ::<protected>
 */
class VgngTest extends PHPUnit_Framework_TestCase
{
    /**
     * Verify that getName returns the expected name.
     *
     * @test
     * @covers ::__construct
     * @covers ::getName
     */
    public function getName()
    {
        $vgng = new Vgng();

        srand(1);
        $this->assertSame("Jackie Chan's Penguin Anthology", $vgng->getName());
    }
}
