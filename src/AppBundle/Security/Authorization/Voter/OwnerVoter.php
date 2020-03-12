<?php

namespace AppBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class OwnerVoter implements VoterInterface
{
    const CREATE = 'create';
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    public function supportsAttribute($attribute)
    {
        return in_array($attribute, array(
            self::CREATE,
            self::VIEW,
            self::EDIT,
            self::DELETE,
        ));
    }

    public function supportsClass($class)
    {
        $classes = array(
            'AppBundle\Entity\Club',
            'AppBundle\Entity\Evenement',
            'AppBundle\Entity\Membre',
            'AppBundle\Entity\Participant',
            'AppBundle\Entity\ClubContact',
        );
        $ok = false;
        foreach($classes as $supportedClass)
        $ok = $ok || $supportedClass === $class || is_subclass_of($class, $supportedClass);

        return $ok;
    }


    public function vote(TokenInterface $token, $post, array $attributes)
    {
        // check if class of this object is supported by this voter
        if (!$this->supportsClass(get_class($post))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        // check if the voter is used correct, only allow one attribute
        // this isn't a requirement, it's just one easy way for you to
        // design your voter
        if (1 !== count($attributes)) {
            throw new \InvalidArgumentException(
                'Only one attribute is allowed for VIEW or EDIT'
            );
        }

        // set the attribute to check against
        $attribute = $attributes[0];

        // check if the given attribute is covered by this voter
        if (!$this->supportsAttribute($attribute)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        // get current logged in user
        $user = $token->getUser();

        // make sure there is a user object (i.e. that the user is logged in)
        if (!$user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }

        switch ($attribute) {
            /*
            case self::VIEW:
                // the data object could have for example a method isPrivate()
                // which checks the Boolean attribute $private
                if (!$post->isPrivate()) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                break;
            */
            case self::VIEW:
                // we assume that our data object has a method getOwner() to
                // get the current owner user entity for this data object
                if ($user->getId() === $post->getUser()->getId()) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                break;

            case self::CREATE:
                if ($user->getId() === $post->getUser()->getId()) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                break;

            case self::EDIT:
               if ($user->getId() === $post->getUser()->getId()) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                break;

            case self::DELETE:
                if ($user->getId() === $post->getUser()->getId()) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                break;
        }

        return VoterInterface::ACCESS_DENIED;

    }
}