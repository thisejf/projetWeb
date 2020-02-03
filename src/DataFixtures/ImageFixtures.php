<?php

namespace App\DataFixtures;

use App\Entity\Images;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public const NBR_IMAGE_PRESTATAIRE = 10;
    public const NBR_PRESTATAIRE_PHOTO = 5;

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::NBR_IMAGE_PRESTATAIRE; $i++){
            for($j = 0; $j <self::NBR_PRESTATAIRE_PHOTO; $j++){
                $images = new Images();
                $images->setImage('http://placeimg.com/640/480/people/'.$i.$j);
                $images->setPrestatairePhotos($this->getReference(PrestataireFixtures::PRESTATAIRE_REFERENCE.$i));
                $manager->persist($images);
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
