<?php

namespace App\DataFixtures;

use App\Entity\Images;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public const NBR_IMAGE_CATEGORIE_DE_SERVICES = 5;
    public const NBR_IMAGE_PRESTATAIRE = 10;

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::NBR_IMAGE_CATEGORIE_DE_SERVICES; $i++){
            $images = new Images();
            $images->setImage('https://loremflickr.com/320/240?random='.$i);
            $images->setCategorieDeServices($this->getReference(CategorieDeServicesFixtures::CATEGORIE_DE_SERVICE_REFERENCE.$i));
            $manager->persist($images);
        }
        $manager->flush();

        for ($i = 0; $i < self::NBR_IMAGE_PRESTATAIRE; $i++){
            $images = new Images();
            $images->setImage('https://loremflickr.com/320/240/dog?random='.$i);
            $images->setPrestataire($this->getReference(PrestataireFixtures::PRESTATAIRE_REFERENCE.$i));
            $manager->persist($images);
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
