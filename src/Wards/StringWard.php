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

    public bool $nullable = false;

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
            $this->invalid_message = "$this->name is required";

            return false;
        } elseif (empty($value) && $this->nullable) {
            return true;
        }

        if (!is_string($value)) {
            $this->invalid_message = "$this->name must be a string";

            return false;
        }

        if (is_int($this->min) && strlen($value) < $this->min) {
            $this->invalid_message = "$this->name must be at least $this->min characters long";

            return false;
        }

        if (is_int($this->max) && strlen($value) > $this->max) {
            $this->invalid_message = "$this->name must be at most $this->max characters long";

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