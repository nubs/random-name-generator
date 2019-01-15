<?php
namespace Nubs\RandomNameGenerator;

use PHPUnit\Framework\TestCase;
use Cinam\Randomizer\Randomizer;
use Cinam\Randomizer\NumberGenerator;

/**
 * @coversDefaultClass \Nubs\RandomNameGenerator\Alliteration
 * @covers ::<protected>
 */
class AlliterationTest extends TestCase
{
    /**
     * Verify basic behavior of getName().
     *
     * @test
     * @covers ::__construct
     * @covers ::getName
     *
     * @return void
     */
    public function getNameBasic()
    {
        $generator = new Alliteration();
        $parts = explode(' ', $generator->getName());
        $this->assertCount(2, $parts);
        $this->assertSame($parts[0][0], $parts[1][0]);
    }

    /**
     * Verify basic behavior of getName() with a forced random generator.
     *
     * @test
     * @covers ::__construct
     * @covers ::getName
     *
     * @return void
     */
    public function getNameForced()
    {
        $numberGenerator = $this->createMock(NumberGenerator::class);
        $numberGenerator->expects($this->exactly(2))->method('getInt')->will($this->onConsecutiveCalls(20, 5));
        $randomizer = new Randomizer($numberGenerator);

        $generator = new Alliteration($randomizer);
        $this->assertSame('Black Bear', $generator->getName());
    }

    /**
     * Verify basic behavior of __toString().
     *
     * @test
     * @covers ::__construct
     * @covers ::__toString
     * @covers ::getName
     *
     * @return void
     */
    public function toStringBasic()
    {
        $generator = new Alliteration();
        $parts = explode(' ', (string)$generator);
        $this->assertCount(2, $parts);
        $this->assertSame($parts[0][0], $parts[1][0]);
    }
}
