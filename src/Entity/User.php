<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Annotation\Groups;


// *          ,"post"={
// *              "path"="/create/user",
// *              "method"="POST",
// *              "controller"=CreateUserController::class}
// *     },

/**
 * @ApiResource(
 *     collectionOperations=
 *     {
 *          "get"={"normalizationContext"={"groups"={"users:read"}}},"post"
 *     },
 *     itemOperations=
 *     {
 *          "get"={"normalizationContext"={"groups"={"user:get"}}},
 *          "delete"
 *     },
 *     attributes=
 *     {
 *           "pagination_items_per_page"=5,
 *           "formats"={"jsonld", "json", "html", "jsonhal", "csv"={"text/csv"}}
 *     },
 *     normalizationContext={"groups"={"users:read","user:get"}},
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     * @ORM\Column(type="string", length=255)
     * @Groups({"users:read","user:get"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
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
    private $customerId;

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

    public function getCustomerId(): ?Customer
    {
        return $this->customerId;
    }

    public function setCustomerId(?Customer $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }
}
