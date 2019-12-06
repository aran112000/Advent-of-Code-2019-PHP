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

        foreach ($this->{'part' . $part . 'Tests'} as $input => $expectedOutput) {
            $input = explode(static::INPUT_DELIMITER, $input);

            $actualOutput = $this->{'getPart' . $part}($input, true);

            if ($expectedOutput != $actualOutput) {
                if (is_array($input)) {
                    $input = implode(static::INPUT_DELIMITER, $input);
                }

                $errors[] = 'Input: ' . $input . ', expected: ' . $expectedOutput . ', received: ' . $actualOutput;
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
