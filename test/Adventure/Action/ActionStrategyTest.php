<?php

namespace Rsh\Adventure\Action;


class ActionStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function getActionDataProvider(): array
    {
        return [
            [ExitAction::class, 'exit'],
            [InventoryAction::class, 'inventory'],
            [GoToAction::class, 'go to'],
            [GoToAction::class, 'go to Foo'],
            [NoAction::class, ''],
            [NoAction::class, 'bogus'],
        ];
    }


    /**
     * @dataProvider getActionDataProvider
     */
    public function testGetAction($expected, $text)
    {
        $action = (new ActionStrategy())->getAction($text);
        $this->assertSame($expected, get_class($action));
    }
}