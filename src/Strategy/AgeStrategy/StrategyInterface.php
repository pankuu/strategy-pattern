<?php


namespace App\Strategy\AgeStrategy;


interface StrategyInterface
{
    public function canProcess($data);
    public function process($data);
}