<?php

namespace Rsh\Adventure\Action\Subject;


abstract class Subject
{
    /** @var  string $name */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public abstract function getName(): string;
}