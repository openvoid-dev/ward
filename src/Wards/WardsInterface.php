<?php

namespace OpenVoid\Ward\Wards;

interface WardsInterface
{
    public string $name {
        get;
        set;
    }

    public string $invalid_message {
        get;
        set;
    }

    public function __construct(string $item_name);

    public function validate(mixed $value): bool;
}