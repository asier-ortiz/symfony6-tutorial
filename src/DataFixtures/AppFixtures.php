<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('test@test.com');
        $user1->setPassword($this->userPasswordHasher->hashPassword($user1, '12345678'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('john@test.com');
        $user2->setPassword($this->userPasswordHasher->hashPassword($user2, '12345678'));
        $manager->persist($user2);

        $micropost1 = new MicroPost();
        $micropost1->setTitle('Welcome to Poland!');
        $micropost1->setText('Welcome to Poland!');
        $micropost1->setCreated(new DateTime());
        $micropost1->setAuthor($user1);
        $manager->persist($micropost1);

        $micropost2 = new MicroPost();
        $micropost2->setTitle('Welcome to US!');
        $micropost2->setText('Welcome to US!');
        $micropost2->setCreated(new DateTime());
        $micropost2->setAuthor($user2);
        $manager->persist($micropost2);

        $micropost3 = new MicroPost();
        $micropost3->setTitle('Welcome to Germany!');
        $micropost3->setText('Welcome to Germany!');
        $micropost3->setCreated(new DateTime());
        $micropost3->setAuthor($user1);
        $manager->persist($micropost3);

        $manager->flush();
    }
}
