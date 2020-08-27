<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 2; $i++) {

            //Persistence de 2 users non admin
            $user = new User();
            $user->setPrenom($faker->unique(true)->firstName);
            $user->setEmail($faker->unique(true)->email);
            $user->setPassword($this->encoder->encodePassword($user, "mdp123"));
            $manager->persist($user);
        }

        //Persisence d'un admin
        $admin = new User();
        $admin->setPrenom("Joachim");
        $admin->setEmail("kim@dwwm.as");
        $admin->setPassword($this->encoder->encodePassword($admin, 'demo123'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();
    }
}
