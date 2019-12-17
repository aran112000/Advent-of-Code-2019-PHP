<?php

namespace AdventOfCode;

/**
 * Class Test
 *
 * @package AdventOfCode
 */
abstract class Test
{

    protected array $partOneTests = [];
    protected array $partTwoTests = [];

    protected const INPUT_DELIMITER = "\n";

    /**
     *
     */
    protected function initTests()
    {
        if ($this->partOneTests || $this->partTwoTests) {
            echo 'Running tests...' . PHP_EOL;
        }

        try {
            if ($this->partOneTests) {
                echo 'Part one test results: ' . $this->runTest('One') . PHP_EOL;
            }
            if ($this->partTwoTests) {
                echo 'Part two test results: ' . $this->runTest('Two') . PHP_EOL . PHP_EOL;
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param string $part
     *
     * @return string
     * @throws \Exception
     */
    private function runTest(string $part)
    {
        $errors = [];

        $inputNumber = 0;
        foreach ($this->{'part' . $part . 'Tests'} as $input => $expectedOutput) {
            $inputNumber++;

            $input = explode(static::INPUT_DELIMITER, $input);

            $suggestedOutput = $this->{'getPart' . $part}($input, true);

            if (is_callable($expectedOutput)) {
                $expectedOutput = $expectedOutput($suggestedOutput);
            }

            if ($expectedOutput != $suggestedOutput) {
                $errors[] = 'Input #' . $inputNumber . ' expected: ' . $expectedOutput . ', received: ' . (empty($suggestedOutput) ? 'null' : $suggestedOutput);
            }
        }

        if ($errors) {
            $error = implode(PHP_EOL . ' - ', $errors);

            throw new \Exception('Part ' . strtolower($part) . ' failed with errors:' . PHP_EOL . ' - ' . $error);
        }

        $tests = count($this->{'part' . $part . 'Tests'});

        return 'Passed ' . $tests . '/' . $tests . ' tests';
    }
}
