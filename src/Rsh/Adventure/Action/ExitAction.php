<?php


namespace Rsh\Adventure\Action;


class ExitAction extends Action
{
    const TEXT_MATCH = 'exit';

    public function execute()
    {
        throw new MethodNotImplemented();
    }

    public function isMatchOnText(): bool
    {
        return trim($this->text) === self::TEXT_MATCH;
    }
}