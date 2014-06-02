<?php
namespace Nubs\RandomNameGenerator;

use PHPUnit_Framework_TestCase;
use Cinam\Randomizer\Randomizer;

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
        $numberGenerator = $this->getMock('\Cinam\Randomizer\NumberGenerator', array('getInt'));
        $numberGenerator->expects($this->exactly(3))->method('getInt')->will($this->returnValue(1));
        $randomizer = new Randomizer($numberGenerator);

        $vgng = new Vgng($randomizer);

        $this->assertSame('8-Bit Acid - 3rd Strike', $vgng->getName());
    }
}
