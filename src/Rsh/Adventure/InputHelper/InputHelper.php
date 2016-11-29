<?php

namespace Rsh\Adventure\InputHelper;


class InputHelper
{

    const INPUT_TEXT_EXIT = 'exit';
    const INPUT_TEXT_INVENTORY = 'inventory';

    const INPUT_TEXT_GO_TO = 'go to';

    public function isExitTyped(string $text): bool
    {
        return $text === self::INPUT_TEXT_EXIT;
    }

    public function isInventoryTyped($text): bool
    {
        return $text === self::INPUT_TEXT_INVENTORY;
    }

    public function isGoToTyped(string $text): bool
    {
        return $text === self::INPUT_TEXT_GO_TO;
    }

    public function isGoToWithDirectionTyped(string $text): bool
    {
        $pattern = sprintf('/^%s/i', self::INPUT_TEXT_GO_TO);
        $startsWithGoTo = (bool)preg_match($pattern, $text);
        if ($startsWithGoTo === false) {
            return false;
        }

        $text = $this->filterOutDirection($text);

        // if it is still not empty then it has a direction
        return $text !== '';
    }

    public function isGoToWithDirectionValid(string $text, array $availableDirections): bool
    {
        $givenDirectionName = $this->filterOutDirection($text);
        $filteredResult = array_filter($availableDirections, function($directionName) use ($givenDirectionName) {
            return strcasecmp($givenDirectionName, $directionName) === 0;
        });
        return count($filteredResult) > 0;
    }

    /**
     * @param string $text
     * @return mixed
     */
    private function filterOutDirection(string $text):string
    {
        $text = str_replace('  ', ' ', trim($text));
        $directionName = str_replace(self::INPUT_TEXT_GO_TO, '', strtolower($text));
        return trim($directionName);
    }
}