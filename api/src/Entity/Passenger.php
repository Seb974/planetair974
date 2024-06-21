<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PassengerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PassengerRepository::class)]
#[ApiResource(
    mercure: [ "private" => true ],
    normalizationContext: [ 'groups' => ["passengers_read"]],
)]
#[Get]
#[GetCollection]
#[Post]     // (security: "is_granted('ROLE_ADMIN')")
#[Put]      // (security: "is_granted('ROLE_ADMIN')")
#[Patch]    // (security: "is_granted('ROLE_ADMIN')")
#[Delete]   // (security: "is_granted('ROLE_ADMIN')")
class Passenger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["passengers_read"])]
    private ?int $id = null;

    #[Assert\NotBlank(message: "Un prénom est obligatoire.")]
    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(["passengers_read"])]
    private ?string $name = null;

    #[Assert\NotBlank(message: "Un nom de famille est obligatoire.")]
    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(["passengers_read"])]
    private ?string $lastname = null;

    #[Assert\Email(message: "L'adresse email saisie n'est pas valide.")]
    #[Assert\NotBlank(message: "Une adresse email est obligatoire.")]
    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["passengers_read"])]
    private ?string $email = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Regex(pattern: "/^(?:(?:\+|00)262|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/", message: "Le numéro de téléphone saisi n'est pas valide.")]
    #[Groups(["passengers_read"])]
    private ?string $phone = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(["passengers_read"])]
    private ?\DateTimeInterface $flightDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFlightDate(): ?\DateTimeInterface
    {
        return $this->flightDate;
    }

    public function setFlightDate(?\DateTimeInterface $flightDate): static
    {
        $this->flightDate = $flightDate;

        return $this;
    }
}
