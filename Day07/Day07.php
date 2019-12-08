<?php

namespace AdventOfCode\Day07;

use AdventOfCode\AdventOfCode;

/**
 * Class Day07
 */
class Day07 extends AdventOfCode
{

    const INPUT_DELIMITER = ',';

    protected array $partOneTests = [
        '3,15,3,16,1002,16,10,16,1,16,15,15,4,15,99,0,0' => 43210,
        '3,23,3,24,1002,24,10,24,1002,23,-1,23,101,5,23,23,1,24,23,23,4,23,99,0,0' => 54321,
        '3,31,3,32,1002,32,10,32,1001,31,-2,31,1007,31,0,33,1002,33,7,33,1,33,31,31,1,32,31,31,4,31,99,0,0,0' => 65210,
    ];

    protected array $partTwoTests = [
        '3,26,1001,26,-4,26,3,27,1002,27,2,27,1,27,26,27,4,27,1001,28,-1,28,1005,28,6,99,0,0,5' => 139629729,
        '3,52,1001,52,-5,52,3,53,1,52,56,54,1007,54,5,55,1005,55,26,1001,54,-5,54,1105,1,12,1,53,54,53,1008,54,0,55,1001,55,1,55,2,53,55,53,4,53,1001,56,-1,56,1005,56,6,99,0,0,0,0,10' => 18216,
    ];

    /**
     * @param int[] $input
     *
     * @return int
     */
    public function getPartOne(array $input): int
    {
        $thrusterOutputs = [];
        foreach ($this->getAllNonRepeatingCombinations(range(0, 4)) as $possibleInputs) {
            $output = 0;
            foreach ($possibleInputs as $possibleInput) {
                $output = (new IntcodeComputer($input))->calculate([$possibleInput, $output]);
            }

            $thrusterOutputs[] = $output;
        }

        return max($thrusterOutputs);
    }

    /**
     * @param int[] $input
     *
     * @return int
     */
    public function getPartTwo(array $input): int
    {
        $loop = 0;
        $running = true;
        $thrusterOutputs = [];
        while ($running) {
            $loop++;
            foreach ($this->getAllNonRepeatingCombinations(range(5, 9)) as $possibleInputs) {
                $intcodeComputers = [];
                $output = 0;
                foreach ($possibleInputs as $c => $possibleInput) {
                    if (!isset($intcodeComputers[$c])) {
                        $intcodeComputers[$c] = new IntcodeComputer($input);
                    }

                    $parameters = [$output];
                    if ($loop === 1) {
                        $parameters = [$possibleInput, $output];
                    }

                    $output = $intcodeComputers[$c]->calculate($parameters, function () use (&$running) {
                        $running = false;
                    });
                }

                $thrusterOutputs[] = $output;
            }
        }

        return max($thrusterOutputs);
    }

    protected function getAllNonRepeatingCombinations(array $characters, int $size = null, array $combinations = []): array
    {
        if ($size === null) {
            $size = count($characters);
        }

        if (empty($combinations)) {
            $combinations = array_map(fn($character) => [$character], $characters);
        }

        if ($size === 1) {
            return $combinations;
        }

        $new_combinations = [];
        foreach ($combinations as $combination) {
            foreach ($characters as $character) {
                if (!in_array($character, $combination)) {
                    $new_combination = $combination;
                    $new_combination[] = $character;
                    $new_combinations[] = $new_combination;
                }
            }
        }

        return $this->getAllNonRepeatingCombinations($characters, $size - 1, $new_combinations);
    }
}
