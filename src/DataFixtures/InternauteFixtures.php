<?php

namespace App\DataFixtures;

use App\Entity\Internaute;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InternauteFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_BE');

        for ($i = 0; $i < 10; $i++){
            $internaute = new Internaute();
            $internaute->setNom($faker->lastname);
            $internaute->setPrenom($faker->firstname);
            $internaute->setAdresseNumero($faker->buildingNumber);
            $internaute->setAdresseRue($faker->streetSuffix." ".$faker->streetName);
            $internaute->setLocalite($this->getReference(LocaliteFixtures::LOCALITE_REFERENCE.$faker->numberBetween(0, localiteFixtures::NBR_LOCALITE-1)));
            $internaute->setCodePostal($this->getReference(CodePostalFixtures::CODE_POSTAL_REFERENCE.$faker->numberBetween(0, codePostalFixtures::NBR_CODE_POSTAL-1)));
            $internaute->setCommune($this->getReference(CommuneFixtures::COMMUNE_REFERENCE.$faker->numberBetween(0, CommuneFixtures::NBR_COMMUNE-1)));
            $internaute->setEMail($internaute->getNom()."@".$faker->freeEmailDomain);
            $internaute->setInscription($faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null));
            $internaute->setPassword($this->passwordEncoder->encodePassword($internaute, 'password'.$i));
            $internaute->setRoles(['ROLE_INTERNAUTE']);
            $internaute->setInscriptionConf(true);
            $manager->persist($internaute);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            LocaliteFixtures::class,
            CommuneFixtures::class,
            CodePostalFixtures::class,
        );
    }
}
