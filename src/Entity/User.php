<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations=
 *     {
 *          "get"={"normalization_context"={"groups"={"users:read"}}},"post"
 *     },
 *     itemOperations=
 *     {
 *          "get"={"normalization_context"={"groups"={"user:get"}}},
 *          "delete"
 *     },
 *     attributes=
 *     {
 *           "pagination_items_per_page"=5,
 *           "formats"={"jsonld", "json", "html", "jsonhal", "csv"={"text/csv"}}
 *     },
 *     normalizationContext={"groups"={"users:read","user:get"}},
 *     cacheHeaders={"no-store"},
 * )
 * @UniqueEntity("email", message="Bilemo : This email is already used.")
 * @UniqueEntity("name", message="Bilemo : This name is already used.")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\EntityListeners({"App\Doctrine\CustomerSetUserListener"})
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=3,
     *     max=50,
     *     maxMessage="Bilemo : Name must be 3 characters to 50."
     * )
     * @Groups({"users:read","user:get"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email(
     *     message = "Bilemo : The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @Groups({"users:read","user:get"})
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user:get"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    public function __construct()
    {
        $this->createdAt = (new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
