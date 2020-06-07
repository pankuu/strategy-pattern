<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(5, 'main_users', function ($i) {
            $user = new User();
            $user->setEmail(sprintf('strategy%d@example.com', $i));
            $user->setFirstName($this->faker->firstName);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'foo'
            ));


            return $user;
        });

        $manager->flush();
    }
}
