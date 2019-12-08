<?php

namespace AdventOfCode;

/**
 * Class AdventOfCode
 *
 * @package AdventOfCode
 */
abstract class AdventOfCode extends Test
{
    use Performance;

    private string $day;

    /**
     * @param array $input
     *
     * @return mixed
     */
    abstract public function getPartOne(array $input);

    /**
     * @param array $input
     *
     * @return mixed
     */
    abstract public function getPartTwo(array $input);

    /**
     *
     */
    public function init()
    {
        echo 'Running: ' . $this->getDay() . PHP_EOL . PHP_EOL;

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
    protected function getInput($delimiter = "\n"): array
    {
        return explode($delimiter, trim(file_get_contents($this->getDay() . DIRECTORY_SEPARATOR . 'input.txt')));
    }

    /**
     * @return string
     */
    protected function getDay(): string
    {
        if (!isset($this->day)) {
            $matches = [];
            if (preg_match('/Day(\d+)/', get_called_class(), $matches)) {
                $this->day = $matches[0];

                return $this->day;
            }

            throw new \Exception('Unable to discover the current Day');
        }

        return $this->day;
    }
}
