<?php
declare(strict_types=1);

namespace Podfather\Techtest\Entity;

use Ramsey\Uuid\Uuid;

final class Customer implements EntityInterface
{
    private string $id = '';
    private string $name = '';
    private string $address = '';
    private string $city = '';
    private string $country = '';
    private string $email = '';

    public function __construct(string $id = null)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Customer
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): Customer
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): Customer
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): Customer
    {
        $this->country = $country;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Customer
    {
        $this->email = $email;

        return $this;
    }

    public static function createFromArray(array $input): static
    {
        return (new Customer($input['id']))
            ->setName($input['name'])
            ->setEmail($input['email'])
            ->setAddress($input['address'])
            ->setCity($input['city'])
            ->setCountry($input['country']);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'address' => $this->getAddress(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'email' => $this->getEmail()
        ];
    }
}
