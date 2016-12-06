<?php

namespace Rsh\Adventure\InputHelper;



use Prophecy\Argument;
use Rsh\Adventure\Action\ExitAction;
use Rsh\Adventure\Action\GoToAction;
use Rsh\Adventure\Action\InventoryAction;
use Rsh\Adventure\Action\NoAction;

class ActionStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function getActionDataProvider(): array
    {
        return [
            [$this->mockInputHelper(true, false, false, false), ExitAction::class, 'exit'],
            [$this->mockInputHelper(false, true, false, false), InventoryAction::class, 'inventory'],
            [$this->mockInputHelper(false, false, true, false), GoToAction::class, 'go to'],
            [$this->mockInputHelper(false, false, false, true), GoToAction::class, 'go to Foo'],
            [$this->mockInputHelper(false, false, false, false), NoAction::class, ''],
            [$this->mockInputHelper(false, false, false, false), NoAction::class, 'bogus'],
        ];
    }

    private function mockInputHelper(bool $exitTyped, bool $inventoryTyped, bool $goToTyped, bool $goToWithDirectionTyped): InputHelper
    {
        $inputHelper = $this->prophesize(InputHelper::class);

        $inputHelper->isExitTyped(Argument::any())->willReturn($exitTyped);
        $inputHelper->isInventoryTyped(Argument::any())->willReturn($inventoryTyped);
        $inputHelper->isGoToTyped(Argument::any())->willReturn($goToTyped);
        $inputHelper->isGoToWithDirectionTyped(Argument::any())->willReturn($goToWithDirectionTyped);
        return $inputHelper->reveal();
    }


    /**
     * @dataProvider getActionDataProvider
     */
    public function testGetAction($inputHelper, $expected, $text)
    {
        $action = (new ActionStrategy($inputHelper))->getAction($text);
        $this->assertSame($expected, get_class($action));
    }
}