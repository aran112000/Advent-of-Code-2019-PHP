<?php

namespace AdventOfCode\Day05;

use AdventOfCode\AdventOfCode;

/**
 * Class Day05
 */
class Day05 extends AdventOfCode
{

    protected const INPUT_DELIMITER = ',';

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
