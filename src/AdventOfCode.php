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

        $input = $this->getInput();

        echo 'Part one: ' . $this->getPerf('getPartOne', [$input]) . PHP_EOL;
        echo 'Part two: ' . $this->getPerf('getPartTwo', [$input]);
    }

    /**
     * @return int[]
     */
    private function getInput(): array
    {
        return explode("\n", file_get_contents('input.txt'));
    }
}