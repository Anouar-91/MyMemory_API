<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FrWordRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FrWordRepository::class)
 */
class FrWord
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
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=EnWord::class, inversedBy="frWords")
     */
    private $EnWords;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbError;

    public function __construct()
    {
        $this->EnWords = new ArrayCollection();
        $this->nbError = 0;
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    /**
     * @return Collection<int, EnWord>
     */
    public function getEnWords(): Collection
    {
        return $this->EnWords;
    }

    public function addEnWord(EnWord $enWord): self
    {
        if (!$this->EnWords->contains($enWord)) {
            $this->EnWords[] = $enWord;
        }

        return $this;
    }

    public function removeEnWord(EnWord $enWord): self
    {
        $this->EnWords->removeElement($enWord);

        return $this;
    }

    public function getNbError(): ?int
    {
        return $this->nbError;
    }

    public function setNbError(int $nbError): self
    {
        $this->nbError = $nbError;

        return $this;
    }
}
