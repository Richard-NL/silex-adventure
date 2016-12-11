<?php


namespace Rsh\Adventure\Action\Subject;


class NoSubject implements SubjectInterface
{
    public function getName(): string
    {
        return '';
    }
}