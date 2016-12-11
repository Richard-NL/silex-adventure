<?php


namespace Rsh\Adventure\Action;


use Rsh\Adventure\Action\Subject\Subject;

class GoToAction extends Action
{
    const INPUT_TEXT_GO_TO = 'go to';

    public function execute()
    {
        throw new MethodNotImplemented();
    }

    public function init()
    {
        if (!$this->isGoToWithDirectionTyped()) {
            return;
        }
        $this->subject = new Subject($this->filterOutDirectionName());
    }

    public function isMatchOnText(): bool
    {
        return $this->isGoToTyped($this->text) || $this->isGoToWithDirectionTyped($this->text);
    }

    private function isGoToTyped(): bool
    {
        return $this->text === self::INPUT_TEXT_GO_TO;
    }

    private function isGoToWithDirectionTyped(): bool
    {
        $pattern = sprintf('/^%s/i', self::INPUT_TEXT_GO_TO);
        $startsWithGoTo = (bool)preg_match($pattern, $this->text);
        if ($startsWithGoTo === false) {
            return false;
        }

        $direction = $this->filterOutDirectionName();

        // if it is still not empty then it has a direction
        return $direction !== '';
    }

    /**
     * @param string $text
     * @return mixed
     */
    private function filterOutDirectionName():string
    {
        $text = str_replace('  ', ' ', trim($this->text));
        $directionName = str_replace(self::INPUT_TEXT_GO_TO, '', strtolower($text));
        return trim($directionName);
    }
}
