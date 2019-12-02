<?php

require('../src/Test.php');
require('../src/Performance.php');

abstract class AdventOfCode extends Test
{
    use Performance;

    /**
     *
     */
    public function init()
    {
        $this->initTests();

        $input = $this->getInput(static::INPUT_DELIMITER);

        echo 'Part one: ' . $this->getPerf('getPartOne', [$input, false]) . PHP_EOL;
        echo 'Part two: ' . $this->getPerf('getPartTwo', [$input, false]);
    }

    /**
     * @param string $delimiter
     *
     * @return array
     */
    private function getInput($delimiter = "\n"): array
    {
        return explode($delimiter, file_get_contents('input.txt'));
    }
}