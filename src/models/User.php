<?php

namespace Models;

/**
 * Représente un utilisateur
 * Elle permet de manipuler les données d'un utilisateur
 */
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
     * Initialise un nouvel objet User.
     *
     * @param int $id
     * @param string $lastName
     * @param string $firstName
     * @param string $email
     * @param string $password
     */
    public function __construct(int $id, string $lastName, string $firstName, string $email, string $password)
    {
        $this->id = $id;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->password = $password;
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

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
