<?php

/**
 * Class Day01
 */
class Day01
{

    /**
     * @return int
     */
    public function getPartOne(): int
    {
        foreach ($this->getInput() as $mass) {
            $result[] = $this->getFuel($mass);
        }

        return array_sum($result);
    }

    /**
     * @return int
     */
    public function getPartTwo(): int
    {
        foreach ($this->getInput() as $mass) {
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

    /**
     * @return int[]
     */
    private function getInput(): array
    {
        return explode("\n", file_get_contents('input.txt'));
    }
}

$task = new Day01();

echo 'Part one: ' . $task->getPartOne() . PHP_EOL;
echo 'Part two: ' . $task->getPartTwo();