<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\DataFixtures\AppFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user1 = new User("adminsup");
        $user1->setPassword($this->encoder->encodePassword($user1, "voila"));
        $user1->setnomcomplet("kadiona thales ndecky");
        $user1->setRoles(array("ROLE_SUP_ADMIN"));
        $user1->setIsActif(true);
        $user1->setUsername("KEPHAS");
        $manager->persist($user1);

        $roles3 = new Role();

        $roles1 = new Role();

        $roles2 = new Role();
        
        $roles3->setLibelle("ROLE_SUP_ADMIN");
        $roles1->setLibelle("ROLE_ADMIN");
        $roles2->setLibelle("ROLE_CAISSIER");
        $manager->persist($roles3);
        $manager->persist($roles1);
        $manager->persist($roles2);

        $manager->flush();
    }
}
