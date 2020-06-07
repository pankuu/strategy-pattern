<?php


namespace App\Strategy\AgeStrategy;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ChildStrategy implements StrategyInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function canProcess($items)
    {
        $data = [];
        /** @var User $item */
        foreach ($items as $item) {
            if ($item->getImage() == null && $item->getAge() < 15) {
                $data[] = $item;
            }
        }

        return $data;
    }

    public function process($items): void
    {
        /** @var User $item */
        foreach ($items as $item) {
           $item->setImage('child.jpg');
           $this->entityManager->flush();
       }
    }
}
