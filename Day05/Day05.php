<?php
require('../src/AdventOfCode.php');

/**
 * Class Day05
 */
class Day05 extends AdventOfCode
{

    const INPUT_DELIMITER = ',';

    /**
     * @param int[] $input
     *
     * @return int
     */
    public function getPartOne(array $input): int
    {
        return (new IntcodeComputer(1, $input))->calculate(1);
    }

    /**
     * @param int[] $input
     *
     * @return int
     */
    public function getPartTwo(array $input): int
    {
        return (new IntcodeComputer(2, $input))->calculate(5);
    }
}

(new Day05)->init();