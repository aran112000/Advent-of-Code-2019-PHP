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
        $this->initTests();

        $input = $this->getInput(static::INPUT_DELIMITER);

        echo 'Part one: ' . $this->getPerf('getPartOne', [$input, false]) . PHP_EOL;
        echo 'Part two: ' . $this->getPerf('getPartTwo', [$input, false]);
    }

    /**
     * @param string $delimiter
     *
     * @return array
     * @throws \Exception
     */
    private function getInput($delimiter = "\n"): array
    {
        $matches = [];
        if (preg_match('/Day(\d+)/', get_called_class(), $matches)) {
            return explode($delimiter, file_get_contents($matches[0] . DIRECTORY_SEPARATOR . 'input.txt'));
        }

        throw new \Exception('Unable to discover the current Day');
    }
}
