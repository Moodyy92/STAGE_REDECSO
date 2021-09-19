<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
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
        $manager->flush();

        $admin = new User();
        $admin->setEmail('admin@hotmail.com');
        $admin->setNom('nomAdmin');
        $admin->setPrenom('prenomAdmin');
        $admin->setCivilite('Monsieur');
        $admin->setAdresse('5 rue des admins');
        $admin->setVille('AdminCity');
        $admin->setTelephone('0614547993');
        $admin->setCodePostal('92360');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword(
            $admin,
            "password"
        ));
        $admin->setCreatedAt(new \DateTimeImmutable);
        $manager->persist($admin);
        $manager->flush();
    }
}
