<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $roleUser = new Role();
        $roleUser->setName('User');
        $roleUser->setRole('ROLE_USER');
        $manager->persist($roleUser);

        $roleAdmin = new Role();
        $roleAdmin->setName('Admin');
        $roleAdmin->setRole('ROLE_ADMIN');
        $manager->persist($roleAdmin);

        $this->createMany(10, 'main_users', function($i) use ($manager, $roleUser) {
            $user = new User();
            $user->setEmail(sprintf('user.%d@example.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);
            $user->setActive($this->faker->boolean);
            $user->setPassword('asdfasdf');
            $user->addRole($roleUser);
            $manager->persist($user);
            return $user;
        });

        $this->createMany(3, 'admin_users', function($i) use ($manager, $roleAdmin) {
            $user = new User();
            $user->setActive(true);
            $user->setEmail(sprintf('admin.%d@example.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);
            $user->setPassword('asdfasdf');
            $user->addRole($roleAdmin);
            $manager->persist($user);
            return $user;
        });

        $manager->flush();
    }
}
