<?php

namespace App\DataFixtures;

use App\Entity\CategorieDeServices;
use App\Entity\Prestataire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PrestataireFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRESTATAIRE_REFERENCE = 'prestataire';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_BE');

        for ($i = 0; $i < 10; $i++){
            $prestataire = new Prestataire();
            $prestataire->setNom($faker->company);
            $prestataire->setAdresseNumero($faker->buildingNumber);
            $prestataire->setAdresseRue($faker->streetSuffix." ".$faker->streetName);
            $prestataire->setLocalite($this->getReference(LocaliteFixtures::LOCALITE_REFERENCE.$faker->numberBetween(0, localiteFixtures::NBR_LOCALITE-1)));
            $prestataire->setCodePostal($this->getReference(CodePostalFixtures::CODE_POSTAL_REFERENCE.$faker->numberBetween(0, codePostalFixtures::NBR_CODE_POSTAL-1)));
            $prestataire->setCommune($this->getReference(CommuneFixtures::COMMUNE_REFERENCE.$faker->numberBetween(0, CommuneFixtures::NBR_COMMUNE-1)));
            $prestataire->setEMail(strtolower($faker->firstname."@".str_replace(' ','',$prestataire->getNom()).".com"));
            $prestataire->setEMailContact("info@".str_replace(' ','',$prestataire->getNom()).".com");
            $prestataire->setNumTel($faker->phoneNumber);
            $prestataire->setNumTVA($faker->vat(false));
            $prestataire->setSiteInternet(strtolower("www.".str_replace(' ','',$prestataire->getNom()).".com"));
            $prestataire->addCategorieDeService($this->getReference(CategorieDeServicesFixtures::CATEGORIE_DE_SERVICE_REFERENCE.$faker->numberBetween(0,CategorieDeServicesFixtures::NBR_CATEGORIE_DE_SERVICE-1)));
            $prestataire->setInscription($faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null));

            $manager->persist($prestataire);

            //Sharing Objects between Fixtures
            $this->addReference(self::PRESTATAIRE_REFERENCE.$i, $prestataire);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            LocaliteFixtures::class,
            CommuneFixtures::class,
            CodePostalFixtures::class,
            CategorieDeServicesFixtures::class,
        );
    }
}
