<?php
namespace App\Http\Dto;

class UserDTO
{
    public function __construct(
        private readonly ?string $firstName,
        private readonly ?string $lastName,
        private readonly ?string $email,
        private readonly ?string $password
    ){}

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
}
