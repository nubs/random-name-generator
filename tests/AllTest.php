<?php
namespace Nubs\RandomNameGenerator;

use PHPUnit_Framework_TestCase;
use Cinam\Randomizer\Randomizer;

/**
 * @coversDefaultClass \Nubs\RandomNameGenerator\All
 * @covers ::<protected>
 */
class AllTest extends PHPUnit_Framework_TestCase
{
    /**
     * Verify basic behavior of getName().
     *
     * @test
     * @covers ::__construct
     * @covers ::getName
     * @uses \Nubs\RandomNameGenerator\Alliteration
     * @uses \Nubs\RandomNameGenerator\Vgng
     *
     * @return void
     */
    public function getNameBasic()
    {
        $generator = new All();
        $name = $generator->getName();
        $this->assertRegexp('/.+/', $name);
    }

    /**
     * Verify basic behavior of getName() with a forced random generator.
     *
     * @test
     * @covers ::__construct
     * @covers ::getName
     * @uses \Nubs\RandomNameGenerator\Alliteration
     *
     * @return void
     */
    public function getNameForced()
    {
        $numberGenerator = $this->getMock('\Cinam\Randomizer\NumberGenerator', array('getInt'));
        $numberGenerator->expects($this->exactly(3))->method('getInt')->will($this->onConsecutiveCalls(0, 20, 5));
        $randomizer = new Randomizer($numberGenerator);

        $generator = new All([], $randomizer);
        $this->assertSame('Black Beetle', $generator->getName());
    }
}
