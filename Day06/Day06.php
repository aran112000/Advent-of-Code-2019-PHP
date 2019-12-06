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
K)L
K)YOU
I)SAN' => 4,
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
     *
     * @return int
     */
    public function getPartTwo(array $nodes): int
    {
        $orbits = $this->getOrbits($nodes);

        $pathToYou = $this->getPathToOrbit('YOU', $orbits);
        $pathToSan = $this->getPathToOrbit('SAN', $orbits);

        return $this->getTransfersBetweenPaths($pathToYou, $pathToSan);
    }

    /**
     * Calculate the number of transfers BETWEEN two provided paths
     *
     * @param array $pathA
     * @param array $pathB
     *
     * @return int
     */
    protected function getTransfersBetweenPaths(array $pathA, array $pathB): int
    {
        $stepsBetween = 0;
        for ($i = 0, $max = max(count($pathA), count($pathB)); $i < $max; $i++) {
            if (isset($pathA[$i], $pathB[$i])) {
                if ($pathA[$i] !== $pathB[$i]) {
                    $stepsBetween += 2;
                }

                continue;
            }

            $stepsBetween++;
        }

        return $stepsBetween;
    }

    /**
     * Returns the path from COM to a specified orbit, or an empty array if not found
     *
     * @param string $searchingFor
     * @param array  $orbits
     * @param array  $currentPath
     *
     * @return array
     */
    protected function getPathToOrbit(string $searchingFor, array $orbits, array &$currentPath = []): array
    {
        foreach ($orbits as $orbit => $children) {
            $pathBefore = $currentPath;

            if ($orbit === $searchingFor) {
                return $currentPath;
            }

            $currentPath[] = $orbit;

            if (is_array($children)) {
                if ($result = $this->getPathToOrbit($searchingFor, $children, $currentPath)) {
                    return $currentPath;
                }
            }

            $currentPath = $pathBefore;
        }

        return [];
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
