<?php


namespace Rsh\Adventure\Action;


abstract class Action
{
    public abstract function handleSubject(\Rsh\Adventure\Action\Subject\Subject $subject);
}