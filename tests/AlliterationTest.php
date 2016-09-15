<?php
namespace Nubs\RandomNameGenerator;

use PHPUnit_Framework_TestCase;
use Cinam\Randomizer\Randomizer;

/**
 * @coversDefaultClass \Nubs\RandomNameGenerator\Alliteration
 * @covers ::<protected>
 */
class AlliterationTest extends PHPUnit_Framework_TestCase
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
        $this->assertSame(2, count($parts));
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
        $numberGenerator = $this->createMock('\Cinam\Randomizer\NumberGenerator');
        $numberGenerator->expects($this->exactly(2))->method('getInt')->will($this->onConsecutiveCalls(20, 5));
        $randomizer = new Randomizer($numberGenerator);

        $generator = new Alliteration($randomizer);
        $this->assertSame('Black Bear', $generator->getName());
    }
}
