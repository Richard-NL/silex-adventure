<?php


namespace Rsh\Adventure\Action;

use \Rsh\Adventure\Action\Subject\NoSubject;

class NoActionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSubjectIsNoSubject()
    {
        $action = new NoAction('');
        $this->assertSame(NoSubject::class, get_class($action->getSubject()));
        $action->getSubject();
    }
}
