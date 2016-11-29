<?php

namespace Rsh\Adventure\InputHelper;

class InputHelperTest extends \PHPUnit_Framework_TestCase
{

    private $inputHelper;

    public function setUp()
    {
        $this->inputHelper = new InputHelper();
    }
    public function exitTestDataProvider(): array
    {
        return [
            ['exit', true],
            ['enter', false]
        ];
    }

    public function inventoryProvider(): array
    {
        return [
            ['inventory', true],
            ['my stuff', false]
        ];
    }

    public function goToProvider(): array
    {
        return [
            ['go to', true],
            ['Foo', false]
        ];
    }

    public function goToWithDirectionProvider(): array
    {
        return [
            ['ga naar', false],
            ['go to hell', true],
            ['go to the stairway to heaven', true],
            ['go to ', false]
        ];
    }

    public function goToWithDirectionValidProvider(): array
    {
        return [
            ['go to North', true],
            ['go to East', true],
            ['go to South',true],
            ['go to West', true],
            ['go to Sky', false],
            ['get going Sky', false],
            ['ga naar North', false],
        ];
    }

    /**
     * @dataProvider exitTestDataProvider
     */
    public function testIsExitTyped(string $text, bool $expected)
    {
        $inputHelper = new InputHelper();
        $this->assertSame($expected, $inputHelper->isExitTyped($text));
    }

    /**
     * @dataProvider inventoryProvider
     */
    public function testIsInventoryTyped(string $text, bool $expected)
    {
        $this->assertSame($expected, $this->inputHelper->isInventoryTyped($text));
    }

    /**
     * @dataProvider goToProvider
     */
    public function testIsGoToTyped(string $text, bool $expected)
    {
        $this->assertSame($expected, $this->inputHelper->isGoToTyped($text));
    }

    /**
     * @dataProvider goToWithDirectionProvider
     */
    public function testIsGoWithDirectionTyped(string $text, bool $expected)
    {
        $this->assertSame($expected, $this->inputHelper->isGoToWithDirectionTyped($text));
    }


//    public function testIsGoWithDirectionValid(string $text, string $currentLocationName, bool $expected)
//    {
//        $directionService = $this->prophesize(DirectionServiceIf::class);
//        $directionService->getDirections(Argument::is('Foo'))->willReturn(['North', 'West', 'South', 'East']);
//        $this->assertSame($expected, $this->inputHelper->isGoToWithDirectionValid($text, $currentLocationName, $directionService->reveal()));
//    }

    /**
     * @dataProvider goToWithDirectionValidProvider
     */
    public function testIsGoWithDirectionValid(string $text, $expected)
    {
        $availableDirections = ['North', 'West', 'South', 'East'];
        $this->assertSame($expected, $this->inputHelper->isGoToWithDirectionValid($text, $availableDirections));
    }
}