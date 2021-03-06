<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface,\Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    /**
     * Return the roles granted by the user
     * 
     *      public function getRoles()
     *      {
     *          return array('ROLE_USER');
     *      }
     * 
     * Alternatively the roles migfht be stored on a ''roles '' property,
     * and populated in any number of different ways when the uuser user object is created.
     * 
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }

    /**
     * Return the salt was originally used to encode the password.
     * 
     * this can return null if the password was not encoded using a salt.
     * 
     * @return string|null the salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     * 
     * this is important if, at any given point, sensitive  information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }
    
    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.php
     * @return string the representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserializable.php
     * @param string $serialized <p>
     * the string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized, ['allowed_class' => false]);
    }


}
