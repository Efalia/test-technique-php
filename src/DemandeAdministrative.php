<?php
declare(strict_types = 1);

namespace App;

use App\DemandeAdministrative\API;

final class DemandeAdministrative
{
    private bool $featureFlag;

    private function __construct(bool $featureFlag)
    {
        $this->featureFlag = $featureFlag;
    }

    public static function actif(): self
    {
        return new self(true);
    }

    public static function inactif(): self
    {
        return new self(false);
    }

    /**
     * @template T
     *
     * @param callable(API): T $action
     *
     * @return ?T
     */
    public function __invoke(callable $action)
    {
        return match ($this->featureFlag) {
            true => $action(new API),
            false => null,
        };
    }
}
