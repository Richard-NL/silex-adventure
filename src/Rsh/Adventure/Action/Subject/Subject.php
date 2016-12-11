<?php


namespace Rsh\Adventure\Action\Subject;


class Subject implements SubjectInterface
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}