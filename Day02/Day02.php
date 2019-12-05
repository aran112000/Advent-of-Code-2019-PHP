<?php

namespace AdventOfCode\Day02;

use AdventOfCode\AdventOfCode;

/**
 * Class Day02
 *
 * @package AdventOfCode\Day02
 */
class Day02 extends AdventOfCode
{

    protected const INPUT_DELIMITER = ',';

    protected array $partOneTests = [
        '1,0,0,0,99' => '2',
        '2,3,0,3,99' => '2',
        '2,4,4,5,99,0' => '2',
        '1,9,10,3,2,3,11,0,99,30,40,50' => '3500',
    ];

    protected array $partTwoTests = [
        // No examples
    ];

    /**
     * @param int[] $input
     * @param bool  $test
     *
     * @return string
     */
    public function getPartOne(array $input, $test = false)
    {
        if (!$test) {
            $input[1] = 12;
            $input[2] = 2;
        }

        return $this->calculate($input);
    }

    /**
     * @param int[] $input
     *
     * @return int
     */
    public function getPartTwo(array $input)
    {
        for ($i = 0; $i < 100; $i++) {
            for ($ii = 0; $ii < 100; $ii++) {
                $sampleInput = $input;
                $sampleInput[1] = $i;
                $sampleInput[2] = $ii;

                if ($this->calculate($sampleInput) == 19690720) {
                    return (100 * $i) + $ii;
                }
            }
        }
    }

    /**
     * @param array $input
     *
     * @return mixed
     */
    protected function calculate(array $input)
    {
        foreach (array_chunk($input, 4) as $batch => $instruction) {
            if ($instruction[0] == 1) {
                $input[$instruction[3]] = $input[$instruction[1]] + $input[$instruction[2]];
            } elseif ($instruction[0] == 2) {
                $input[$instruction[3]] = $input[$instruction[1]] * $input[$instruction[2]];
            } elseif ($instruction[0] == 99) {
                break;
            }
        }

        return $input[0];
    }
}
