<?php

namespace App\DataFixtures;

use App\>Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr');
        for ($i = 0; $i < 100 ; $i++){
            $property = new Property();
            $property
                ->setTitle('Mon super bien' . $i);
        }

        $manager->flush();
    }
}
