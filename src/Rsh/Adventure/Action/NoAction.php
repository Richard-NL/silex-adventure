<?php

namespace Rsh\Adventure\Action;


use Rsh\Adventure\Exception\MethodNotImplemented;

class NoAction extends Action
{

    public function execute()
    {
        throw new MethodNotImplemented();
    }

    public function isMatchOnText(): bool
    {
        throw new MethodNotImplemented();
    }
}