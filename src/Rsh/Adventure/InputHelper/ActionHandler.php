<?php

namespace Rsh\Adventure\InputHelper;


use Rsh\Adventure\Action\Action;
use Rsh\Adventure\Action\ExitAction;
use Rsh\Adventure\Action\GoToAction;
use Rsh\Adventure\Action\InventoryAction;
use Rsh\Adventure\Action\NoAction;

class ActionHandler
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