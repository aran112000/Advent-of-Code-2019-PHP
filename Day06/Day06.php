<?php

namespace AdventOfCode\Day06;

use AdventOfCode\AdventOfCode;

/**
 * Class Day06
 */
class Day06 extends AdventOfCode
{

    protected array $partOneTests = [
        'COM)B
B)C
C)D
D)E
E)F
B)G
G)H
D)I
E)J
J)K
K)L' => 42,
    ];

    protected array $partTwoTests = [
        // TODO
    ];

    /**
     * @param string[] $nodes
     *
     * @return int
     */
    public function getPartOne(array $nodes): int
    {
        $orbits = $this->getOrbits($nodes);

        return $this->countOrbits($orbits);
    }

    /**
     * @param string[] $nodes
     */
    public function getPartTwo(array $nodes)
    {
        // TODO
    }

    /**
     * Take the input data and produce a tree structure plotting each of the orbits
     *
     * @param string[] $nodes
     *
     * @return array
     */
    protected function getOrbits(array $nodes): array
    {
        $orbits = [];
        foreach ($nodes as $node) {
            $nodeParts = explode(')', $node);
            $orbits[$nodeParts[0]][$nodeParts[1]] = 'END';
        }

        $sortedOrbits = ['COM' => $orbits['COM']];
        unset($orbits['COM']);

        while ($orbits) {
            array_walk_recursive($sortedOrbits, function (&$value, $key) use (&$orbits, $sortedOrbits) {
                if (isset($orbits[$key])) {
                    $value = $orbits[$key];
                    unset($orbits[$key]);
                }
            });
        }

        return $sortedOrbits;
    }

    /**
     * Count the total number of direct and indirect orbits in the provided data
     *
     * @param array $orbits
     * @param int   $depth
     *
     * @return int
     */
    protected function countOrbits(array $orbits, int $depth = 0): int
    {
        $orbitCount = 0;
        foreach ($orbits as $parent => $orbit) {
            $orbitCount += $depth;

            if (is_array($orbit)) {
                $orbitCount += $this->countOrbits($orbit, $depth + 1);
            }
        }

        return $orbitCount;
    }
}
