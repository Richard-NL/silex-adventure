<?php


namespace Rsh\Adventure\Action;

use Rsh\Adventure\Action\Subject\NoSubject;
use \Rsh\Adventure\Action\Subject\SubjectInterface;

abstract class Action
{
    protected $text;

    protected $subject;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->subject = new NoSubject('');
        $this->init();
    }
    // use this method to initialize stuff in child object
    protected function init()
    {
    }

    public abstract function execute();

    public abstract function isMatchOnText(): bool;

    public function getSubject(): SubjectInterface
    {
        return $this->subject;
    }
}
