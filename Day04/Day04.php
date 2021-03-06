<?php

namespace AdventOfCode\Day04;

use AdventOfCode\AdventOfCode;

/**
 * Class Day04
 *
 * @package AdventOfCode\Day04
 */
class Day04 extends AdventOfCode
{

    protected const INPUT_DELIMITER = '-';

    /**
     * @param int[] $input
     *
     * @return int
     */
    public function getPartOne(array $input)
    {
        $possiblePasswords = [];

        for ($i = $input[0]; $i < $input[1]; $i++) {
            $code = str_pad($i, 6, '0', STR_PAD_LEFT);

            // Check for 6 equal or ascending numbers
            if (preg_match('/^(?=\d{6}$)0*1*2*3*4*5*6*7*8*9*$/', $code)) {
                // Check for the presence of 1 or more adjacent repeating digits
                if (preg_match('/(\d)\1+/', $code)) {
                    $possiblePasswords[] = $code;
                }
            }
        }

        return count($possiblePasswords);
    }

    /**
     * @param int[] $input
     *
     * @return int
     */
    public function getPartTwo(array $input)
    {
        $possiblePasswords = [];

        for ($i = $input[0]; $i < $input[1]; $i++) {
            $code = str_pad($i, 6, '0', STR_PAD_LEFT);

            // Check for 6 equal or ascending numbers
            if (preg_match('/^(?=\d{6}$)0*1*2*3*4*5*6*7*8*9*$/', $code)) {
                // Check for the presence of 1 or more adjacent repeating digits
                $matches = [];
                if (preg_match_all('/(\d)\1+/', $code, $matches)) {
                    foreach ($matches[0] as $match) {
                        if (strlen($match) === 2) {
                            $possiblePasswords[] = $code;

                            break;
                        }
                    }
                }
            }
        }

        return count($possiblePasswords);
    }
}
