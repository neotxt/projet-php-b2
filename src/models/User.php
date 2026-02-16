<?php

namespace Models;

class User
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $lastName;

    /**
     * @var string
     */
    private string $firstName;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $password;

    /**
     * @var bool
     */
    private bool $isAdmin;

    /**
     * Initialise un nouvel objet User.
     * @param int $id
     * @param string $lastName
     * @param string $firstName
     * @param string $email
     * @param string $password
     * @param bool $isAdmin
     */
    public function __construct(int $id, string $lastName, string $firstName, string $email, string $password, bool $isAdmin = false)
    {
        $this->id = $id;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    /**
     * Récupère l'identifiant de l'utilisateur
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Récupère le nom de famille de l'utilisateur.
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Récupère le prénom de l'utilisateur.
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Récupère l'email de l'utilisateur.
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Récupère le mot de passe de l'utilisateur.
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


    public function getName()
    {
        return "$this->firstName $this->lastName";
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
