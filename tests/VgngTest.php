<?php
namespace Nubs\RandomNameGenerator;

use PHPUnit_Framework_TestCase;

function array_rand()
{
    return 1;
}

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
    public function getNameBasic()
    {
        $vgng = new Vgng();

        $this->assertSame('8-Bit Acid - 3rd Strike', $vgng->getName());
    }
}
