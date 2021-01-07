<?php
namespace Nubs\RandomNameGenerator;

use PHPUnit\Framework\TestCase;
use Cinam\Randomizer\NumberGenerator;
use Cinam\Randomizer\Randomizer;

/**
 * @coversDefaultClass \Nubs\RandomNameGenerator\Vgng
 * @covers ::<protected>
 */
class VgngTest extends TestCase
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
        $numberGenerator = $this->createMock(NumberGenerator::class);
        $numberGenerator->expects($this->exactly(3))->method('getInt')->will($this->returnValue(1));
        $randomizer = new Randomizer($numberGenerator);

        $vgng = new Vgng($randomizer);

        $this->assertSame('8-Bit Acid - 3rd Strike', $vgng->getName());
    }

    /**
     * Verify that getName returns a name without similar strings.
     *
     * @test
     * @covers ::__construct
     * @covers ::getName
     */
    public function getNameSimilarName()
    {
        $numberGenerator = $this->createMock(NumberGenerator::class);
        $numberGenerator->expects($this->exactly(4))->method('getInt')->will($this->onConsecutiveCalls(0, 0, 2, 10));
        $randomizer = new Randomizer($numberGenerator);

        $vgng = new Vgng($randomizer);

        $this->assertSame('3D Aerobics Academy', $vgng->getName());
    }

    /**
     * Verify that toString returns the expected name.
     *
     * @test
     * @covers ::__construct
     * @covers ::__toString
     * @covers ::getName
     */
    public function toStringBasic()
    {
        $numberGenerator = $this->createMock(NumberGenerator::class);
        $numberGenerator->expects($this->exactly(3))->method('getInt')->will($this->returnValue(1));
        $randomizer = new Randomizer($numberGenerator);

        $vgng = new Vgng($randomizer);

        $this->assertSame('8-Bit Acid - 3rd Strike', (string)$vgng);
    }
}
