<?php

namespace Models;

class User
{
    private string $lastName;
    private string $firstName;
    private string $email;
    private string $password;

    public function __construct(string $lastName, string $firstName, string $email, string $password)
    {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->password = $password;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
