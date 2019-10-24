<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;


/**
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"get"},
 *     normalizationContext={"groups"="phone_listing:read"},
 *     attributes={
 *           "pagination_items_per_page"=5,
 *           "formats"={"jsonld", "json", "html", "jsonhal", "csv"={"text/csv"}}
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={"marque":"partial"})
 * @ApiFilter(RangeFilter::class, properties={"price"})
 * @ORM\Entity(repositoryClass="App\Repository\PhoneRepository")
 */
class Phone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le nom du téléphone ne doit pas être vide.")
     * @ORM\Column(type="string", length=255)
     * @Groups("phone_listing:read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("phone_listing:read")
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("phone_listing:read")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("phone_listing:read")
     */
    private $price;

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

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        if (strlen($this->description) < 40) {
            return $this->description;
        }
        return substr($this->description, 0, 40).'...';
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

//  Permet de visualiser de délai de création
    public function getCreatedAtAgo():string
    {
        return Carbon::instance($this->getCreatedAt())->diffForHumans();
    }

//    cf __construct
//    public function setCreatedAt(\DateTimeInterface $createdAt): self
//    {
//        $this->createdAt = $createdAt;
//
//        return $this;
//    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
