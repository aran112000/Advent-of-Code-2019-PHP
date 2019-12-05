<?php

namespace AdventOfCode\Day03;

use AdventOfCode\AdventOfCode;

/**
 * Class Day03
 *
 * @package AdventOfCode\Day03
 */
class Day03 extends AdventOfCode
{

    private array $currentPosition = [
        'X' => 0,
        'Y' => 0,
    ];

    protected array $partOneTests = [
        'R75,D30,R83,U83,L12,D49,R71,U7,L72
U62,R66,U55,R34,D71,R55,D58,R83' => 159,

        'R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51
U98,R91,D20,R16,D67,R40,U7,R15,U6,R7' => 135,
    ];

    protected array $partTwoTests = [
        'R75,D30,R83,U83,L12,D49,R71,U7,L72
U62,R66,U55,R34,D71,R55,D58,R83' => 610,

        'R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51
U98,R91,D20,R16,D67,R40,U7,R15,U6,R7' => '410',
    ];

    /**
     * @param string[] $wires
     *
     * @return int
     */
    public function getPartOne(array $wires)
    {
        $grid = [];
        $intersections = [];

        foreach ($wires as $wire) {
            $wirePath = [];
            $this->currentPosition = ['X' => 0, 'Y' => 0]; // Reset

            $directions = explode(',', $wire);

            foreach ($directions as $position) {
                $direction = $position[0];
                $distance = substr($position, 1);

                for ($i = 0; $i < $distance; $i++) {
                    if ($direction === 'R') {
                        $this->currentPosition['X'] += 1;
                    } elseif ($direction === 'L') {
                        $this->currentPosition['X'] -= 1;
                    } elseif ($direction === 'U') {
                        $this->currentPosition['Y'] += 1;
                    } elseif ($direction === 'D') {
                        $this->currentPosition['Y'] -= 1;
                    }

                    $currentCoordinate = $this->currentPosition['X'] . ',' . $this->currentPosition['Y'];

                    if (isset($grid[$currentCoordinate]) && !isset($wirePath[$currentCoordinate]) && $currentCoordinate !== '0,0') {
                        // Track intersections with other wires but not when at the starting position (0,0)
                        $intersections[] = $currentCoordinate;
                    }

                    $grid[$currentCoordinate] = $wirePath[$currentCoordinate] = 'X';
                }
            }
        }

        $distancesFromCentralPort = [];
        foreach ($intersections as $intersectionCoordinates) {
            $distancesFromCentralPort[] = array_sum(array_map('abs', explode(',', $intersectionCoordinates)));
        }

        return min($distancesFromCentralPort);
    }

    /**
     * @param string[] $wires
     *
     * @return int
     */
    public function getPartTwo(array $wires)
    {
        $grid = [];
        $intersectionCoordinates = [];

        foreach ($wires as $wireNumber => $wire) {
            $wirePath = [];
            $this->currentPosition = ['X' => 0, 'Y' => 0]; // Reset

            $wireSteps = 0;

            $directions = explode(',', $wire);

            foreach ($directions as $position) {
                $direction = $position[0];
                $distance = substr($position, 1);

                for ($i = 0; $i < $distance; $i++) {
                    $wireSteps++;

                    if ($direction === 'R') {
                        $this->currentPosition['X'] += 1;
                    } elseif ($direction === 'L') {
                        $this->currentPosition['X'] -= 1;
                    } elseif ($direction === 'U') {
                        $this->currentPosition['Y'] += 1;
                    } elseif ($direction === 'D') {
                        $this->currentPosition['Y'] -= 1;
                    }

                    $currentCoordinate = $this->currentPosition['X'] . ',' . $this->currentPosition['Y'];

                    if (isset($grid[$currentCoordinate]) && !isset($wirePath[$currentCoordinate]) && $currentCoordinate !== '0,0') {
                        $intersectionCoordinates[] = $currentCoordinate;
                    }

                    $grid[$currentCoordinate][$wireNumber] = $wirePath[$currentCoordinate][$wireNumber] = $wireSteps;
                }
            }
        }

        $intersectionSteps = [];
        foreach ($intersectionCoordinates as $intersectionCoordinate) {
            $intersectionSteps[] = array_sum($grid[$intersectionCoordinate]);
        }

        return min($intersectionSteps);
    }
}

(new Day03)->init();
