<?php

/**
 * Class Test
 */
abstract class Test {

    protected array $partOneTests = [];
    protected array $partTwoTests = [];

    /**
     *
     */
    protected function initTests()
    {
        echo 'Running tests...' . PHP_EOL;

        try {
            echo 'Part one test results: ' . $this->runTest('One') . PHP_EOL;
            echo 'Part two test results: ' . $this->runTest('Two') . PHP_EOL . PHP_EOL;
        } catch (Exception $e) {
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
            $actualOutput = $this->{'getPart' . $part}([$input]);

            if ($expectedOutput != $actualOutput) {
                $errors[] = 'Input "' . $input . '" expected "' . $expectedOutput . '" but received "' . $actualOutput . '"';
            }
        }

        if ($errors) {
            throw new Exception('Part ' . strtolower($part) . ' failed with errors:' . PHP_EOL . ' - ' . implode(PHP_EOL . ' - ', $errors));
        }

        $tests = count($this->{'part' . $part . 'Tests'});

        return 'Passed ' . $tests . '/' . $tests . ' tests';
    }
}