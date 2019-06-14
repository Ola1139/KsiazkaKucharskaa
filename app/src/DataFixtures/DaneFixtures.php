<?php
/**
 * User fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Dane;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class DaneFixtures.
 */
class DaneFixtures extends AbstractBaseFixtures
{
    /**
     * Password encoder.
     *
     * @var \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserFixtures constructor.
     *
     * @param \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $passwordEncoder Password encoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Load.
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(10, 'users', function ($i) {
            $user = new Dane();
            $user->setEmail(sprintf('user%d@example.com', $i));
           $user ->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'user1234'
            ));

            return $user;
        });

        $this->createMany(3, 'admins', function ($i) {
            $user = new Dane();
            $user->setEmail(sprintf('admin%d@example.com', $i));
            $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'admin1234'
            ));

            return $user;
        });

        $manager->flush();
    }
}