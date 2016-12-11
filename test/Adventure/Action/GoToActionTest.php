<?php


namespace Rsh\Adventure\Action;

use Rsh\Adventure\Action\Subject\Subject;
use Rsh\Adventure\Action\Subject\NoSubject;

class GoToActionTest extends \PHPUnit_Framework_TestCase
{
    public function subjectReturnTypeProvider(): array
    {
        return [
            [Subject::class, 'go to hell'],
            [NoSubject::class, ''],
        ];
    }

    /**
     * @param string $class
     * @param string $text
     * @dataProvider subjectReturnTypeProvider
     */
    public function testGetSubjectReturnType(string $class, string $text = '')
    {
        $action = new GoToAction($text);
        $this->assertSame($class, get_class($action->getSubject()));
    }

}
