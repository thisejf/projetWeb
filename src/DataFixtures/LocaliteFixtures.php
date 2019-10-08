<?php

namespace App\DataFixtures;

use App\Entity\Localite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LocaliteFixtures extends Fixture
{
    //Sharing Objects between Fixtures
    public const LOCALITE_REFERENCE = 'localite';

    public const NBR_LOCALITE = 5;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_BE');

        for ($i = 0; $i < self::NBR_LOCALITE; $i++){
            $localite = new Localite();
            $localite->setLocalite($faker->province);
            $manager->persist($localite);

            //Sharing Objects between Fixtures
            $this->addReference(self::LOCALITE_REFERENCE.$i, $localite);
        }
        $manager->flush();
    }
}
