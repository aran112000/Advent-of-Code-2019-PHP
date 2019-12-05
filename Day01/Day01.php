<?php

namespace AdventOfCode\Day01;

use AdventOfCode\AdventOfCode;

/**
 * Class Day01
 *
 * @package AdventOfCode\Day05
 */
class Day01 extends AdventOfCode
{

    protected array $partOneTests = [
        12 => 2,
        14 => 2,
        1969 => 654,
        100756 => 33583,
    ];

    protected array $partTwoTests = [
        14 => 2,
        1969 => 966,
        100756 => 50346,
    ];

    /**
     * @param int[] $input
     *
     * @return int
     */
    public function getPartOne(array $input): int
    {
        foreach ($input as $mass) {
            $result[] = $this->getFuel($mass);
        }

        return array_sum($result);
    }

    /**
     * @param int[] $input
     *
     * @return int
     */
    public function getPartTwo(array $input): int
    {
        foreach ($input as $mass) {
            $result[] = $fuel = $this->getFuel($mass);

            while ($fuel = $this->getFuel($fuel)) {
                $result[] = $fuel;
            }
        }

        return array_sum($result);
    }

    /**
     * @param int $mass
     *
     * @return int
     */
    protected function getFuel(int $mass): int
    {
        return max(floor($mass / 3) - 2, 0);
    }
}
