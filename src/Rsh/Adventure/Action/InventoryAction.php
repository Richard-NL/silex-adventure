<?php


namespace Rsh\Adventure\Action;


class InventoryAction extends Action
{
    const INPUT_TEXT_INVENTORY = 'inventory';

    public function execute()
    {
        throw new MethodNotImplemented();
    }

    public function isMatchOnText(): bool
    {
        return $this->text === self::INPUT_TEXT_INVENTORY;
    }
}