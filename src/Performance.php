<?php
trait Performance
{

    /**
     * Annotate responses to the console with execution times
     *
     * @param string $functionToCall
     * @param array  $parameters
     *
     * @return string
     */
    protected function getPerf(string $functionToCall, array $parameters = []): string
    {
        $startTime = microtime(true);
        $response = $this->$functionToCall(...$parameters);
        $runTime = microtime(true) - $startTime;

        return '`' . $response . '`' . ' (Completed in ' . round($runTime, 4) . 's)';
    }
}