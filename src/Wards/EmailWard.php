<?php

namespace OpenVoid\Ward\Wards;

class EmailWard implements WardsInterface
{
    public string $name {
        get {
            return $this->name;
        }
        set {
            $this->name = $value;
        }
    }

    public string $invalid_message {
        get {
            return $this->invalid_message;
        }
        set {
            $this->invalid_message = $value;
        }
    }

    public bool $nullable = false;

    public function __construct(string $item_name)
    {
        $this->name = $item_name;
    }

    public function validate(mixed $value): bool
    {
        if (empty($value) && !$this->nullable) {
            $this->invalid_message = "$this->name must be a valid email address";

            return false;
        }

        if (!is_string($value)) {
            $this->invalid_message = "$this->name must be a valid email address";

            return false;
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->invalid_message = "$this->name must be a valid email address";

            return false;
        }

        return true;
    }

    public function nullable(): self {
        $this->nullable = true;

        return $this;
    }
}