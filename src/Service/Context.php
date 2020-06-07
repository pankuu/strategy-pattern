<?php


namespace App\Service;


use App\Strategy\AgeStrategy\StrategyInterface;

class Context
{
    private $strategies = [];

    public function addStrategy(StrategyInterface $strategy)
    {
        $this->strategies[] = $strategy;
    }

    public function handle(array $data): void
    {
        /** @var StrategyInterface $strategy */
        foreach ($this->strategies as $strategy) {
            if ($items = $strategy->canProcess($data)) {
                $strategy->process($items);
            }
        }
    }
}