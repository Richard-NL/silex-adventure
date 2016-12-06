<?php

namespace Rsh\Adventure\Action;


use Rsh\Adventure\Exception\MethodNotImplemented;

class NoAction extends Action
{

    public function handleSubject(\Rsh\Adventure\Action\Subject\Subject $subject)
    {
        throw new MethodNotImplemented();
    }
}