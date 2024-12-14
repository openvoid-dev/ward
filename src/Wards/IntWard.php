<?php

namespace OpenVoid\Ward\Wards;

class IntWard implements WardsInterface
{
    public string $name;

    public string $invalid_message {
        get {
            return $this->invalid_message;
        }
        set {
            $this->invalid_message = $value;
        }
    }

    protected bool $nullable = false;

    /**
     * @var int|null
     */
    private ?int $min;

    /**
     * @var int|null
     */
    private ?int $max;

    public function __construct(string $item_name)
    {
        $this->name = $item_name;
    }

    public function validate(mixed $value): bool
    {
        if (empty($value) && !$this->nullable) {
            $this->invalid_message = "$this->name must be an integer";

            return false;
        }

        if (!ctype_digit(strval($value))) {
            $this->invalid_message = "$this->name value must be and integer";

            return false;
        }

        if (is_int($this->min) && $value <= $this->min) {
            $this->invalid_message = "$this->name value must be equal to or higher than $this->min";

            return false;
        }

        if (is_int($this->max) && $value >= $this->max) {
            $this->invalid_message = "$this->name value must be equal to or less than $this->min";

            return false;
        }

        return true;
    }

    public function nullable(): self
    {
        $this->nullable = true;

        return $this;
    }

    public function min(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function max(int $max): self
    {
        $this->max = $max;

        return $this;
    }
}