<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EnToFrRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=EnToFrRepository::class)
 */
class EnToFr
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $frWord;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $enWord;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrWord(): ?string
    {
        return $this->frWord;
    }

    public function setFrWord(string $frWord): self
    {
        $this->frWord = $frWord;

        return $this;
    }

    public function getEnWord(): ?string
    {
        return $this->enWord;
    }

    public function setEnWord(string $enWord): self
    {
        $this->enWord = $enWord;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
