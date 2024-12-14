<?php

namespace OpenVoid\Ward;

use OpenVoid\Ward\Wards\StringWard;

class WardBlueprint
{
    protected array $items = [];

    public function string(string $item_name): StringWard
    {
        $item          = new StringWard($item_name);
        $this->items[] = $item;

        return $item;
    }

    public function int(string $item_name): IntWard
    {

    }

    public function email(string $item_name): EmailWard
    {

    }
}