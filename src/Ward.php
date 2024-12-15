<?php

namespace OpenVoid\Ward;

use Closure;
use OpenVoid\Ward\Wards\WardsInterface;

final class Ward
{
    public array $data = [];

    private array $wards = [];

    private array $errors = [];

    public function __construct(Closure $callback)
    {
        $ward_blueprint = new WardBlueprint();

        $callback($ward_blueprint);

        $this->wards = $ward_blueprint->get_wards();
    }

    public function validate(array $data): bool
    {
        $this->data = $data;

        /**
         * @var $ward WardsInterface
         */
        foreach ($this->wards as $ward_item_name => $ward) {
            $is_validated = $ward->validate($this->data[$ward_item_name] ?? null);

            if (!$is_validated) {
                $this->errors[$ward_item_name] = $ward->invalid_message;
            }
        }

        if (!empty($this->errors)) {
            return false;
        }

        return true;
    }

    public function get_errors(): array
    {
        return $this->errors;
    }

    public function get_data(): array
    {
        return $this->data;
    }
}