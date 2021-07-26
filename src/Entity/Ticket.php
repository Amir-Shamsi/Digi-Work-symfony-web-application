<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tickets")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="date")
     */
    private $reservedDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $problemSubject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productModel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productBrand;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $details;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $uploadedImagesFilename = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tracingNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeImmutable $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getReservedDate(): ?\DateTimeInterface
    {
        return $this->reservedDate;
    }

    public function setReservedDate(\DateTimeInterface $reservedDate): self
    {
        $this->reservedDate = $reservedDate;

        return $this;
    }

    public function getProblemSubject(): ?string
    {
        return $this->problemSubject;
    }

    public function setProblemSubject(string $problemSubject): self
    {
        $this->problemSubject = $problemSubject;

        return $this;
    }

    public function getProductModel(): ?string
    {
        return $this->productModel;
    }

    public function setProductModel(string $productModel): self
    {
        $this->productModel = $productModel;

        return $this;
    }

    public function getProductBrand(): ?string
    {
        return $this->productBrand;
    }

    public function setProductBrand(string $productBrand): self
    {
        $this->productBrand = $productBrand;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getUploadedImagesFilename(): ?array
    {
        return $this->uploadedImagesFilename;
    }

    public function setUploadedImagesFilename(?array $uploadedImagesFilename): self
    {
        $this->uploadedImagesFilename = $uploadedImagesFilename;

        return $this;
    }

    public function getTracingNumber(): ?string
    {
        return $this->tracingNumber;
    }

    public function setTracingNumber(string $tracingNumber): self
    {
        $this->tracingNumber = $tracingNumber;

        return $this;
    }
}
