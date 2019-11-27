<?php

namespace App\DataFixtures;

use App\Entity\Stage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class StageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_BE');

        for ($i = 0; $i < 10; $i++){
            for($j = 0; $j < 5; $j++){
                $stage = new Stage();
                $stage->setNom($faker->word);
                $stage->setDescription($faker->text($maxNbChars = 200));
                $stage->setDebut($faker->dateTimeBetween($startDate = 'now', $endDate = '+ 1 month', $timezone = null));
                $stage->setFin($faker->dateTimeBetween($startDate = $stage->getDebut(), $endDate = '+ 1 month', $timezone = null));
                $stage->setPrestataire($this->getReference(PrestataireFixtures::PRESTATAIRE_REFERENCE.$i));
                $stage->setTarif($faker->randomNumber(2));
                $manager->persist($stage);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            PrestataireFixtures::class
        );
    }
}
