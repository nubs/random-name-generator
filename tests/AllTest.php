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
     * @covers ::create
     * @covers ::getName
     * @uses \Nubs\RandomNameGenerator\Alliteration
     * @uses \Nubs\RandomNameGenerator\Vgng
     *
     * @return void
     */
    public function getNameBasic()
    {
        $generator = All::create();
        $name = $generator->getName();
        $this->assertRegexp('/.+/', $name);
    }

    /**
     * Verify basic behavior of getName() with a forced random generator.
     *
     * @test
     * @covers ::__construct
     * @covers ::create
     * @covers ::getName
     * @uses \Nubs\RandomNameGenerator\Alliteration
     *
     * @return void
     */
    public function getNameForced()
    {
        $numberGenerator = $this->createMock('\Cinam\Randomizer\NumberGenerator');
        $numberGenerator->expects($this->exactly(2))->method('getInt')->will($this->onConsecutiveCalls(20, 5));
        $randomizer = new Randomizer($numberGenerator);

        $generator = new All([new Alliteration($randomizer)]);
        $this->assertSame('Black Bear', $generator->getName());
    }
}
