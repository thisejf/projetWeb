<?php

namespace App\DataFixtures;

use App\Entity\CategorieDeServices;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CategorieDeServicesFixtures extends Fixture
{
    //Sharing Objects between Fixtures
    public const CATEGORIE_DE_SERVICE_REFERENCE = 'categorieDeService';

    public const NBR_CATEGORIE_DE_SERVICE = 5;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_BE');

        for ($i = 0; $i < self::NBR_CATEGORIE_DE_SERVICE; $i++){
            $categorieDeServices = new CategorieDeServices();
            $categorieDeServices->setDescription($faker->text);
            $categorieDeServices->setNom($faker->jobTitle);
            $manager->persist($categorieDeServices);

            //Sharing Objects between Fixtures
            $this->addReference(self::CATEGORIE_DE_SERVICE_REFERENCE.$i, $categorieDeServices);
        }
        $manager->flush();
    }
}
