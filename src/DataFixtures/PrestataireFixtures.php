<?php

namespace App\DataFixtures;

use App\Entity\Images;
use App\Entity\Prestataire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PrestataireFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public const PRESTATAIRE_REFERENCE = 'prestataire';
    public const IMAGE_PROFIL_REFERENCE = 'image_profil';

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
            $prestataire->setEMail(strtolower('superman'."@".str_replace(' ','',$prestataire->getNom()).".com"));
            $prestataire->setEMailContact("info@".str_replace(' ','',$prestataire->getNom()).".com");
            $prestataire->setNumTel($faker->phoneNumber);
            $prestataire->setNumTVA($faker->vat(false));
            $prestataire->setSiteInternet(strtolower("www.".str_replace(' ','',$prestataire->getNom()).".com"));
            $prestataire->addCategorieDeService($this->getReference(CategorieDeServicesFixtures::CATEGORIE_DE_SERVICE_REFERENCE.$faker->numberBetween(0,CategorieDeServicesFixtures::NBR_CATEGORIE_DE_SERVICE-1)));
            $prestataire->setInscription($faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null));
            $prestataire->setPassword($this->passwordEncoder->encodePassword($prestataire, 'password'.$i));
            $prestataire->setRoles(['ROLE_PRESTATAIRE']);
            $prestataire->setInscriptionConf(true);
            //image de profil
            $images = new Images();
            $images->setImage('https://loremflickr.com/320/240/dog?random='.$i);
            $manager->persist($images);
            //Sharing Objects between Fixtures
            $this->addReference(self::IMAGE_PROFIL_REFERENCE.$i, $images);
            $prestataire->setImage($this->getReference(PrestataireFixtures::IMAGE_PROFIL_REFERENCE.$i));

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
