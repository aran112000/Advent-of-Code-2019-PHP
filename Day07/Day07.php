<?php

namespace AdventOfCode\Day07;

use AdventOfCode\AdventOfCode;

/**
 * Class Day07
 */
class Day07 extends AdventOfCode
{

    const INPUT_DELIMITER = ',';

    protected array $partTwoTests = [
        // TODO
    ];

    /**
     * @param int[] $input
     *
     * @return int
     */
    public function getPartOne(array $input): int
    {
        $thrusterOutputs = [];
        foreach ($this->getAllNonRepeatingCombinations(range(0, 4)) as $possibleInput) {
            $output = 0;
            for ($i = 0; $i < 5; $i++) {
                $output = (new IntcodeComputer($input))->calculate($possibleInput[$i], $output);
            }

            $thrusterOutputs[] = $output;
        }

        return max($thrusterOutputs);
    }

    /**
     * @param int[] $input
     */
    public function getPartTwo(array $input)
    {
        // TODO
    }

    protected function getAllNonRepeatingCombinations(array $characters, int $size = null, array $combinations = []): array
    {
        if ($size === null) {
            $size = count($characters);
        }

        if (empty($combinations)) {
            $combinations = array_map(fn ($character) => [$character], $characters);
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
