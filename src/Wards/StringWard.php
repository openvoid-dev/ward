<?php

namespace OpenVoid\Ward\Wards;

class StringWard implements WardsInterface
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

    protected ?int $min = null;

    protected ?int $max = null;

    public function __construct(string $item_name)
    {
        $this->name = $item_name;
    }

    public function validate(mixed $value): bool
    {
        // * Check if its null and null is allowed
        if (empty($value) && !$this->nullable) {
            return false;
        }

        if (!is_string($value)) {
            return false;
        }

        if (is_int($this->min) && strlen($value) < $this->min) {
            return false;
        }

        if (is_int($this->max) && strlen($value)> $this->max) {
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



    public function invalid_message(string $invalid_message): WardsInterface
    {
        // TODO: Implement invalid_message() method.
    }
}