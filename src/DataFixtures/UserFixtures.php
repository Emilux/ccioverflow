<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Faker\Factory as Faker;

class UserFixtures extends Fixture
{
    /**
     * Permet d'encoder un mot de passe
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();
        //add user
        $user = new User();
        $user
            ->setEmail('admin@email.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->encoder->encodePassword($user, 'admin'))
        ;
        $manager->persist($user);

        for ($i=0; $i < 100; $i++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setPassword($this->encoder->encodePassword($user, 'password'))
            ;
            $manager->persist($user);
        }

        $manager->flush();
    }

}
