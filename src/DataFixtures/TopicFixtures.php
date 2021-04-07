<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Repository\UserRepository;
use App\Entity\Topic;

class TopicFixtures extends Fixture implements DependentFixtureInterface
{
    private $userRepository;

    public function __construct(UserRepository $UserRepository){
        $this->userRepository = $UserRepository;
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }

    public function load(ObjectManager $manager)
    {
        $users = $this->userRepository->findAll();
        for ($i=0; $i < 100; $i++) {
            $randomId = rand(1, count($users)-1);
            $user=$users[$randomId];
            $topic = new Topic();
            $topic
                ->setTitre('Lorem ipsum')
                ->setMessage('Lorem ipsum dolor sit tamer')
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setUser($user)
            ;
            $manager->persist($topic);
        }

        $manager->flush();
    }

}
