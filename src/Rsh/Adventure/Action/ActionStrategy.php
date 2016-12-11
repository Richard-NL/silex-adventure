<?php

namespace Rsh\Adventure\Action;


class ActionStrategy
{

    const actionClasses = [
        ExitAction::class,
        GoToAction::class,
        InventoryAction::class,
//        NoAction::class
    ];


    public function getAction($userInputText): Action
    {
        foreach (self::actionClasses as $actionClass) {
            /** @var Action $action */
            $action = new $actionClass($userInputText);
            if ($action->isMatchOnText()) {
                return $action;
            }
        }

        return new NoAction($userInputText);
    }
}