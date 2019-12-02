<?php

for ($i = 3; $i <= 25; $i++) {
    $day = str_pad($i, 2, '0', STR_PAD_LEFT);

    $fileContents = <<<TEST
## Day $day results 

```console
Coming soon...
```
TEST;
    file_put_contents('C:\Users\Aran Reeks\PhpstormProjects\Advent of Code 2019\Advent-of-Code-2019-PHP\Day' . $day . '\README.md', $fileContents);
}