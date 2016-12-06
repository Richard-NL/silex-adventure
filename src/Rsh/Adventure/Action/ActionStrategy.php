<?php

namespace Rsh\Adventure\Action;

use \Rsh\Adventure\InputHelper\InputHelper;

class ActionStrategy
{
    private $inputHelper;

    public function __construct(InputHelper $inputHelper)
    {
        $this->inputHelper = $inputHelper;
    }

    public function getAction($userInputText): Action
    {
        if ($this->inputHelper->isExitTyped($userInputText)) {
            return new ExitAction();
        }

        if ($this->inputHelper->isInventoryTyped($userInputText)) {
            return new InventoryAction();
        }

        if ($this->inputHelper->isGoToTyped($userInputText) || $this->inputHelper->isGoToWithDirectionTyped($userInputText)) {
            return new GoToAction();
        }
        return new NoAction();
    }
}