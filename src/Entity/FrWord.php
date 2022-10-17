<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FrWordRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 * normalizationContext={
 *      "groups"={"frWord_read"}
 * },
 * )
 * @ORM\Entity(repositoryClass=FrWordRepository::class)
 */
class FrWord
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"enWord_read", "frWord_read"})

     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"enWord_read", "frWord_read"})

     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"enWord_read", "frWord_read"})

     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"enWord_read", "frWord_read"})

     */
    private $updatedAt;



    /**
     * @ORM\Column(type="integer")
     * @Groups({"enWord_read", "frWord_read"})

     */
    private $nbError;

    /**
     * @ORM\ManyToOne(targetEntity=EnWord::class, inversedBy="frWords")
     * @Groups({"frWord_read"})
     */
    private $enWord;


    public function __construct()
    {
        $this->nbError = 0;
        $this->createdAt = new \DateTime();
        $this->enWords = new ArrayCollection();
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



    public function getNbError(): ?int
    {
        return $this->nbError;
    }

    public function setNbError(int $nbError): self
    {
        $this->nbError = $nbError;

        return $this;
    }

    public function getEnWord(): ?EnWord
    {
        return $this->enWord;
    }

    public function setEnWord(?EnWord $enWord): self
    {
        $this->enWord = $enWord;

        return $this;
    }
}
