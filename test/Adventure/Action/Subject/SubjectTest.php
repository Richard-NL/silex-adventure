<?php


namespace Rsh\Adventure\Action\Subject;


class SubjectTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $subject = new Subject('Hell');
        $this->assertSame('Hell', $subject->getName());
    }
}
