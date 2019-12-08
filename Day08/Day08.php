<?php

namespace AdventOfCode\Day08;

use AdventOfCode\AdventOfCode;

/**
 * Class Day08
 */
class Day08 extends AdventOfCode
{

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
        $lowestZeroCount = null;
        $lowestZeroCountLayer = null;

        $imageLayers = $this->decodeImage(25, 6, $input);
        foreach ($imageLayers as $i => $imageLayer) {
            $stringedImageLayer = implode('', $imageLayer);

            $zeroCount = substr_count($stringedImageLayer, '0');

            if ($lowestZeroCount === null || $zeroCount < $lowestZeroCount) {
                $lowestZeroCount = $zeroCount;
                $lowestZeroCountLayer = $stringedImageLayer;
            }
        }

        return substr_count($lowestZeroCountLayer, '1') * substr_count($lowestZeroCountLayer, '2');
    }

    /**
     * @param int[] $input
     */
    public function getPartTwo(array $input)
    {
        // TODO
    }

    protected function decodeImage(int $width, int $height, array $rawImageData): array
    {
        $imageLayers = [];

        while ($rawImageData) {
            $image = [];
            for ($h = 0; $h < $height; $h++) {
                $row = [];
                for ($w = 0; $w < $width; $w++) {
                    $row[] = array_shift($rawImageData);
                }
                $image[$h] = implode('', $row);
            }

            $imageLayers[] = $image;
        }

        return $imageLayers;
    }

    /**
     * @param string $delimiter
     *
     * @return array
     */
    protected function getInput($delimiter = "\n"): array
    {
        $input = trim(file_get_contents($this->getDay() . DIRECTORY_SEPARATOR . 'input.txt'));

        return str_split($input, 1);
    }
}
