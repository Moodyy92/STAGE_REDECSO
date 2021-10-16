<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Marque;
use App\Entity\Produit;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Client;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager)
    {
        $redecso = new Entreprise();
        $redecso->setNom('REDECSO');
        $redecso->setSiret('80197363700011');
        $redecso->setCodeAPE('4120A');
        $redecso->setNumTVAIntracommunautaire('FR 47801973637');
        $redecso->setTelephone('0609222226');
        $redecso->setAdresse('90 routes de Montreuil');
        $redecso->setCp(93230);
        $redecso->setVille('Romainville');
        $redecso->setCapital(8000);
        $redecso->setCodeBanque('10107');
        $redecso->setCodeGuichet('00651');
        $redecso->setCodeBIC('BREDFRPPXXX');
        $redecso->setNumCompte('00029026808');
        $redecso->setCleCompte(55);
        $redecso->setDomiciliationCompte('BRED PARIS SAINT FARGEAU');
        $redecso->setIBAN('FR76 1010 7006 5100 0290 2680 855');
        $redecso->setLogo('1logo.png');
        $redecso->setEmail('redecso@outlook.fr');
        $manager->persist($redecso);


        $admin = new User();
        $admin->setEmail('admin@hotmail.fr');
        $admin->setNom('nomAdmin');
        $admin->setPrenom('prenomAdmin');
        $admin->setCivilite('Monsieur');
        $admin->setAdresse('5 rue des admins');
        $admin->setVille('AdminCity');
        $admin->setTelephone('0614327993');
        $admin->setCodePostal('92360');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword(
            $admin,
            "password"
        ));
        $admin->setCreatedAt(new \DateTimeImmutable);
        $manager->persist($admin);

        $directeurCommercial = new User();
        $directeurCommercial->addEntreprise($redecso);
        $directeurCommercial->setEmail('redecso@outlook.fr');
        $directeurCommercial->setNom('Vandeputte');
        $directeurCommercial->setPrenom('Herve');
        $directeurCommercial->setCivilite('Monsieur');
        $directeurCommercial->setAdresse('5 rue fontaine henry IV');
        $directeurCommercial->setVille('Chaville');
        $directeurCommercial->setTelephone('0609222226');
        $directeurCommercial->setCodePostal('92370');
        $directeurCommercial->setRoles(['ROLE_DIRECTEUR_COMMERCIAL']);
        $directeurCommercial->setPassword($this->passwordHasher->hashPassword(
            $directeurCommercial,
            "password"
        ));
        $directeurCommercial->setCreatedAt(new \DateTimeImmutable);
        $manager->persist($directeurCommercial);

        $directeurTechnique = new User();

        $directeurTechnique->addEntreprise($redecso);
        $directeurTechnique->setEmail('redecsoHaddadi@outlook.fr');
        $directeurTechnique->setNom('Haddadi');
        $directeurTechnique->setPrenom('Tahar');
        $directeurTechnique->setCivilite('Monsieur');
        $directeurTechnique->setAdresse('34 rue des Tahar');
        $directeurTechnique->setVille('Paris');
        $directeurTechnique->setTelephone('0628239277');
        $directeurTechnique->setCodePostal('75370');
        $directeurTechnique->setRoles(['ROLE_DIRECTEUR_TECHNIQUE']);
        $directeurTechnique->setPassword($this->passwordHasher->hashPassword(
            $directeurTechnique,
            "password"
        ));
        $directeurTechnique->setCreatedAt(new \DateTimeImmutable);
        $manager->persist($directeurTechnique);
        
        

//////////////////////////////////// CLIENT ///////////////////////////////////////
        $client = new Client();
        $client->setNom('Rollet');
        $client->setPrenom('Mathieu');
        $client->setEntreprise('');
        $client->setCivilite('Mr');
        $client->setVille('Meudon');
        $client->setAdresse('10 avenue médéric');
        $client->setCodePostal('92360');
        $client->setCpltAdresse('');
        $client->setTelephone('0625321545');
        $client->setEmail('Mathieu@hotmail.fr');
        $manager->persist($client);
        

        $client = new Client();
        $client->setNom('Roberto');
        $client->setPrenom('Robert');
        $client->setEntreprise('');
        $client->setCivilite('Mr');
        $client->setVille('Espagne');
        $client->setAdresse('3 rue sina');
        $client->setCodePostal('654123');
        $client->setCpltAdresse(' un complément d adresse');
        $client->setTelephone('0625321545');
        $client->setEmail('roberto@hotmail.fr');
        $manager->persist($client);
        

        $client = new Client();
        $client->setNom('Gradasso');
        $client->setPrenom( 'Lambert');
        $client->setEntreprise('');
        $client->setCivilite('Mr');
        $client->setVille('MARSEILLE');
        $client->setAdresse('3, cours Franklin Roosevelt');
        $client->setCodePostal('13009');
        $client->setCpltAdresse(' un complément d adresse');
        $client->setTelephone('04.39.33.22.42');
        $client->setEmail('GradassoLambert@jourrapide.com');
        $manager->persist($client);
        

        $client = new Client();
        $client->setNom('Marquis');
        $client->setPrenom('Aurélie ');
        $client->setEntreprise('');
        $client->setCivilite('Mme');
        $client->setVille('VÉLIZY-VILLACOUBLAY');
        $client->setAdresse('89, boulevard d Alsace');
        $client->setCodePostal('78140 ');
        $client->setCpltAdresse(' un complément d adresse');
        $client->setTelephone('01.18.58.60.93');
        $client->setEmail('AurelieMarquis@hotmail.fr');
        $manager->persist($client);
        

        $client = new Client();
        $client->setNom('Davignon');
        $client->setPrenom('Sidney ');
        $client->setEntreprise('');
        $client->setCivilite('Mr');
        $client->setVille('MÉRIGNAC');
        $client->setAdresse('11, rue Reine Elisabeth');
        $client->setCodePostal('33700');
        $client->setCpltAdresse(' un complément d adresse');
        $client->setTelephone('05.28.13.87.64');
        $client->setEmail('DavignonSyd@hotmail.fr');
        $manager->persist($client);
        

////////////////////////////////////MARQUE ALTERNA/////////////////////////////////
        $marqueAlterna = new Marque();
        $marqueAlterna ->setLibelle('Alterna');
        $manager->persist($marqueAlterna );
        

        $produit = new Produit();
        $produit->setMarque($marqueAlterna);
        $produit->setLibelle('Mitigeur évier ');
        $produit->setPrix('126');
        $manager->persist($produit);
        

        $produit = new Produit();
        $produit->setMarque($marqueAlterna);
        $produit->setLibelle('Mitigeur lavabo');
        $produit->setPrix('128');
        $manager->persist($produit);
        

        $produit = new Produit();
        $produit->setMarque($marqueAlterna);
        $produit->setLibelle('Mitigeur douche');
        $produit->setPrix('132');
        $manager->persist($produit);
        

////////////////////////////////////MARQUE GROHE ///////////////////////////////////////
        $marqueGrohe = new Marque();
        $marqueGrohe->setLibelle('GROHE');
        $manager->persist($marqueGrohe);
        

        $produit = new Produit();
        $produit->setMarque($marqueGrohe);
        $produit->setLibelle('Mitigeur bain douche ');
        $produit->setPrix('167');
        $manager->persist($produit);
        

        $produit = new Produit();
        $produit->setMarque($marqueGrohe);
        $produit->setLibelle('Mitigeur lavabo');
        $produit->setPrix('154');
        $manager->persist($produit);
        

        $produit = new Produit();
        $produit->setMarque($marqueGrohe);
        $produit->setLibelle('Mitigeur douche');
        $produit->setPrix('159');
        $manager->persist($produit);
        

        $produit = new Produit();
        $produit->setMarque($marqueGrohe);
        $produit->setLibelle('Mitigeur Evier');
        $produit->setPrix('190');
        $manager->persist($produit);
        


////////////////////////////////////MARQUE NICOLL////////////////////////////////////////////
        $marqueNicoll = new Marque();
        $marqueNicoll->setLibelle('Nicoll');
        $manager->persist($marqueNicoll);
        

        $produit = new Produit();
        $produit->setMarque($marqueNicoll);
        $produit->setLibelle('Ensemble douche Lisa 3 jets');
        $produit->setPrix('56');
        $manager->persist($produit);
        

        $produit = new Produit();
        $produit->setMarque($marqueNicoll);
        $produit->setLibelle('Gerasco, Ensemble douche Lisa 3 jets ');
        $produit->setPrix('59');
        $manager->persist($produit);
        

////////////////////////////////////MARQUE LITTORAL2///////////////////////////////////////
        $marqueLittoral2 = new Marque();
        $marqueLittoral2->setLibelle('Littoral2');
        $manager->persist($marqueLittoral2);
        

        $produit = new Produit();
        $produit->setMarque($marqueLittoral2);
        $produit->setLibelle('Radiateur 1000w rayonnant ');
        $produit->setPrix('199');
        $manager->persist($produit);
        

        $produit = new Produit();
        $produit->setMarque($marqueLittoral2);
        $produit->setLibelle('Radiateur 1500w rayonnant ');
        $produit->setPrix('229');
        $manager->persist($produit);
        

        $produit = new Produit();
        $produit->setMarque($marqueLittoral2);
        $produit->setLibelle('Radiateur 2000w rayonnant ');
        $produit->setPrix('274');
        $manager->persist($produit);
        

////////////////////////////////////MARQUE BRIVE///////////////////////////////////////

        $marqueBrive = new Marque();
        $marqueBrive->setLibelle('BRIVE');
        $manager->persist($marqueBrive);
        

        $produit = new Produit();
        $produit->setMarque($marqueBrive);
        $produit->setLibelle('Lavabo sur colonne 55 x 45 F/P');
        $produit->setPrix('213');
        $manager->persist($produit);
        

        $produit = new Produit();
        $produit->setMarque($marqueBrive);
        $produit->setLibelle('Lavabo sur colonne 50 x 43 F/P');
        $produit->setPrix('253');
        $manager->persist($produit);
        $manager->flush();

    }
}
