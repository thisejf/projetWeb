<?php

namespace App\DataFixtures;

use App\Entity\Prestataire;
use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class Promotionfixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_BE');

        for ($i = 0; $i < 10; $i++){
            for($j = 0; $j < 5; $j++){
                $promotion = new Promotion();
                $promotion->setNom($faker->word);
                $promotion->setDescription($faker->text($maxNbChars = 200));
                $promotion->setDebut($faker->dateTimeBetween($startDate = 'now', $endDate = '+ 1 month', $timezone = null));
                $promotion->setFin($faker->dateTimeBetween($startDate = $promotion->getDebut(), $endDate = '+ 1 month', $timezone = null));
                $promotion->setPrestataire($this->getReference(PrestataireFixtures::PRESTATAIRE_REFERENCE.$i));
                $promotion->setCategorieDeServices($this->getReference(CategorieDeServicesFixtures::CATEGORIE_DE_SERVICE_REFERENCE.$j));
                $manager->persist($promotion);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CategorieDeServicesFixtures::class,
            PrestataireFixtures::class
        );
    }
}
