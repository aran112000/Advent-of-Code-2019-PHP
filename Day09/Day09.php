<?php

namespace AdventOfCode\Day09;

use AdventOfCode\AdventOfCode;

/**
 * Class Day09
 */
class Day09 extends AdventOfCode
{

    public function __construct()
    {
        $this->partOneTests = [
            '109,1,204,-1,1001,100,1,100,1008,100,16,101,1006,101,0,99' => '109,1,204,-1,1001,100,1,100,1008,100,16,101,1006,101,0,99',
            '1102,34915192,34915192,7,4,7,99,0' => function ($suggested_answer) {
                // Should output a 16-digit number
                return (is_numeric($suggested_answer) && strlen($suggested_answer) === 16 ? $suggested_answer : 'A 16-digit number');
            },
            '104,1125899906842624,99' => '1125899906842624',
        ];

        $this->partTwoTests = [
            // TODO
        ];
    }

    /**
     * @param int[] $input
     */
    public function getPartOne(array $input)
    {
        // TODO
    }

    /**
     * @param int[] $input
     */
    public function getPartTwo(array $input)
    {
        // TODO
    }
}
