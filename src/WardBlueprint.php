<?php

namespace OpenVoid\Ward;

use OpenVoid\Ward\Wards\EmailWard;
use OpenVoid\Ward\Wards\IntWard;
use OpenVoid\Ward\Wards\StringWard;

class WardBlueprint
{
    protected array $items = [];

    public function string(string $item_name): StringWard
    {
        $item                    = new StringWard($item_name);
        $this->items[$item_name] = $item;

        return $item;
    }

    public function int(string $item_name): IntWard
    {
        $item                    = new IntWard($item_name);
        $this->items[$item_name] = $item;

        return $item;
    }

    public function email(string $item_name): EmailWard
    {
        $item                    = new EmailWard($item_name);
        $this->items[$item_name] = $item;

        return $item;
    }

    public function get_wards(): array
    {
        return $this->items;
    }
}