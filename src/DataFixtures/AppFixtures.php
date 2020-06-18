<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
           
        $admin = new User();
        $admin->setEmail('barbara.carme@app-features.net');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'appfeature45'
        ));

        $manager->persist($admin);



        $manager->flush();
    }
}
