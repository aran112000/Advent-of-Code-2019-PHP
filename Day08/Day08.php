<?php

namespace AdventOfCode\Day08;

use AdventOfCode\AdventOfCode;

/**
 * Class Day08
 */
class Day08 extends AdventOfCode
{

    protected const PIXEL_BLACK = '0';
    protected const PIXEL_WHITE = '1';
    protected const PIXEL_TRANSPARENT = '2';

    /**
     * @param int[][] $imageLayers
     *
     * @return int
     */
    public function getPartOne(array $imageLayers): int
    {
        $lowestZeroCount = null;
        $lowestZeroCountLayer = null;

        foreach ($imageLayers as $imageLayer) {
            $zeroCount = substr_count($imageLayer, static::PIXEL_BLACK);

            if ($lowestZeroCount === null || $zeroCount < $lowestZeroCount) {
                $lowestZeroCount = $zeroCount;
                $lowestZeroCountLayer = $imageLayer;
            }
        }

        return substr_count($lowestZeroCountLayer, static::PIXEL_WHITE) * substr_count($lowestZeroCountLayer, static::PIXEL_TRANSPARENT);
    }

    /**
     * @param int[][] $imageLayers
     *
     * @return string
     */
    public function getPartTwo(array $imageLayers): string
    {
        $finalImage = $imageLayers[0];
        unset($imageLayers[0]); // Don't loop this first row again

        while ($pos = strpos($finalImage, static::PIXEL_TRANSPARENT)) {
            foreach ($imageLayers as $imageLayer) {
                if ($imageLayer[$pos] !== static::PIXEL_TRANSPARENT) {
                    $finalImage[$pos] = $imageLayer[$pos];

                    break;
                }
            }
        }

        return $this->drawImage($finalImage);
    }

    /**
     * @param string $finalImage
     *
     * @return string
     */
    protected function drawImage(string $finalImage): string
    {
        $image = PHP_EOL;
        foreach (str_split($finalImage, 25) as $value) {
            $image .= strtr($value, [
                '0' => ' ',
                '1' => '█',
            ]) . PHP_EOL;
        }

        return $image;
    }

    /**
     * @param string $delimiter
     *
     * @return array
     */
    protected function getInput($delimiter = "\n"): array
    {
        $input = trim(file_get_contents($this->getDay() . DIRECTORY_SEPARATOR . 'input.txt'));

        return str_split($input, 25*6);
    }
}
