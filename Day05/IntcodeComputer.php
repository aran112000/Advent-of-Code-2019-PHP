<?php
/**
 * Class IntcodeComputer
 */
class IntcodeComputer
{

    const OPCODE_ADD = 1;
    const OPCODE_MULTIPLY = 2;
    const OPCODE_INPUT = 3;
    const OPCODE_OUTPUT = 4;
    const OPCODE_JUMP_IF_TRUE = 5;
    const OPCODE_JUMP_IF_FALSE = 6;
    const OPCODE_LESS_THEN = 7;
    const OPCODE_EQUALS = 8;
    const OPCODE_FINISHED = 99;

    const OPCODE_PARAMETER_COUNT = [
        self::OPCODE_ADD => 4,
        self::OPCODE_MULTIPLY => 4,
        self::OPCODE_INPUT => 2,
        self::OPCODE_OUTPUT => 2,
        self::OPCODE_JUMP_IF_TRUE => 3,
        self::OPCODE_JUMP_IF_FALSE => 3,
        self::OPCODE_LESS_THEN => 4,
        self::OPCODE_EQUALS => 4,
    ];

    const PARAMETER_MODE_POSITION = 0;

    /**
     * @var int
     */
    private int $version;
    /**
     * @var int[]
     */
    private array $instructions;

    /**
     * IntcodeComputer constructor.
     *
     * @param int   $version Used to define support for calculations between parts 1 and 2
     * @param int[] $instructions
     */
    public function __construct(int $version, array $instructions)
    {
        $this->version = $version;
        $this->instructions = $instructions;
    }

    /**
     * @param int[] $inputs
     *
     * @return int
     */
    public function calculate(int ...$inputs): int
    {
        for ($i = 0, $count = count($this->instructions); $i < $count; $i += 0) {
            $opcode = (int) substr($this->instructions[$i], -2);

            if ($opcode === static::OPCODE_FINISHED) {
                break;
            }

            $instruction = [];
            for ($ii = 0; $ii < static::OPCODE_PARAMETER_COUNT[$opcode]; $ii++) {
                $instruction[] = $this->instructions[$i+$ii];
            }

            $i += static::OPCODE_PARAMETER_COUNT[$opcode];

            if ($opcode === static::OPCODE_ADD) {
                $this->setValue($instruction, $this->getValue($instruction, 1) + $this->getValue($instruction, 2));

                continue;
            }

            if ($opcode === static::OPCODE_MULTIPLY) {
                $this->setValue($instruction, $this->getValue($instruction, 1) * $this->getValue($instruction, 2));

                continue;
            }

            if ($opcode === static::OPCODE_INPUT) {
                $this->setValue($instruction, array_shift($inputs));

                continue;
            }

            if ($opcode === static::OPCODE_OUTPUT) {
                if ($this->getValue($instruction, 1)) {
                    return $this->getValue($instruction, 1);
                }

                continue;
            }

            // Support for Day05, Part 2
            if ($this->version === 2) {
                if ($opcode === static::OPCODE_JUMP_IF_TRUE) {
                    if ($value = $this->getValue($instruction, 1)) {
                        $i = $this->getValue($instruction, 2);
                    }

                    continue;
                }

                if ($opcode === static::OPCODE_JUMP_IF_FALSE) {
                    if (!$this->getValue($instruction, 1)) {
                        $i = $this->getValue($instruction, 2);
                    }

                    continue;
                }

                if ($opcode === static::OPCODE_LESS_THEN) {
                    if ($this->getValue($instruction, 1) < $this->getValue($instruction, 2)) {
                        $this->setValue($instruction, 1);
                    } else {
                        $this->setValue($instruction, 0);
                    }

                    continue;
                }

                if ($opcode === static::OPCODE_EQUALS) {
                    if ($this->getValue($instruction, 1) === $this->getValue($instruction, 2)) {
                        $this->setValue($instruction, 1);
                    } else {
                        $this->setValue($instruction, 0);
                    }

                    continue;
                }
            }
        }

        return $this->instructions[0];
    }

    /**
     * @param int[] $instruction
     * @param int   $valueNumber
     *
     * @return int
     */
    protected function getValue(array $instruction, int $valueNumber): int
    {
        if ($this->getModes($valueNumber, $instruction) === static::PARAMETER_MODE_POSITION) {
            return $this->instructions[$instruction[$valueNumber]];
        }

        return $instruction[$valueNumber];
    }

    /**
     * @param int[] $instruction
     * @param int   $value
     */
    protected function setValue(array $instruction, int $value): void
    {
        $this->instructions[end($instruction)] = $value;
    }

    /**
     * Parameter modes are single digits, one per parameter, read right-to-left
     * from the opcode: the first parameter's mode is in the hundreds digit,
     * the second parameter's mode is in the thousands digit, the third
     * parameter's mode is in the ten-thousands digit, and so on. Any missing
     * modes are 0.
     *
     * @param int   $valueNumber
     * @param array $instruction
     *
     * @return int
     */
    protected function getModes(int $valueNumber, array $instruction): int
    {
        $instruction = $instruction[0] / 100;

        if ($valueNumber == 1 && $instruction % 10 > 0 || $valueNumber == 2 && ($instruction / 10) % 10 > 0) {
            return 1;
        }

        return 0;
    }
}