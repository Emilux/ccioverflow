<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Topic;

class TopicFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        for ($i=0; $i < 100; $i++) {
            $topic = new Topic();
            $topic
                ->setTitre('Lorem ipsum')
                ->setMessage('Lorem ipsum dolor sit tamer')
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
            ;
            $manager->persist($topic);
        }

        $manager->flush();
    }

}
