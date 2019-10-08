<?php

namespace App\DataFixtures;

use App\Entity\Commune;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class CommuneFixtures extends Fixture
{
    //Sharing Objects between Fixtures
    public const COMMUNE_REFERENCE = 'commune';

    public const NBR_COMMUNE = 50;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_BE');

        for ($i = 0; $i < self::NBR_COMMUNE; $i++){
            $commune = new Commune();
            $commune->setCommune($faker->city);
            $manager->persist($commune);

            //Sharing Objects between Fixtures
            $this->addReference(self::COMMUNE_REFERENCE.$i, $commune);
        }
        $manager->flush();
    }
}
