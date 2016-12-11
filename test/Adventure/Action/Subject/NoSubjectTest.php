<?php


namespace Rsh\Adventure\Action\Subject;


class NoSubjectTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $subject = new NoSubject('');
        $this->assertSame('', $subject->getName());
    }
}
