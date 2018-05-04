<?php

namespace App\Entity;

use App\Model\IdentifiableEntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="tbl_user")
 */
class User
{
    use IdentifiableEntityTrait;

    /**
     * @ORM\Column(nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(nullable=true)
     */
    private $email;

    public function __toString()
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }
}
