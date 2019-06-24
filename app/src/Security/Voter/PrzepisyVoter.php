<?php
/**
 * Przepisy voter.
 */
namespace App\Security\Voter;

use App\Entity\Przepisy;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class PrzepisyVoter.
 */
class PrzepisyVoter extends Voter
{
    /**
     * Security helper.
     *
     * @var \Symfony\Component\Security\Core\Security
     */
    private $security;

    /**
     * OrderVoter constructor.
     *
     * @param \Symfony\Component\Security\Core\Security $security Security helper
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed  $subject   The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['MANAGE'])
            && $subject instanceof Przepisy;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string         $attribute
     * @param mixed          $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case 'MANAGE':
                // this is the author!
                if ($subject->getAutor()->getUser()== $user) {
                    return true;
                }
                break;
        }
        return false;

    }
}