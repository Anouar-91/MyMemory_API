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
 * subresourceOperations={
 *  "api_en_words_fr_words_get_subresource"={
 *      "normalization_context"={
 *          "groups"={"fr_words_subresource"}
 *      }
 *  }
 * },
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
     * @Groups({"fr_words_subresource","enWord_read", "frWord_read"})

     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"fr_words_subresource","enWord_read", "frWord_read"})

     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"fr_words_subresource","enWord_read", "frWord_read"})

     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"fr_words_subresource","enWord_read", "frWord_read"})

     */
    private $updatedAt;



    /**
     * @ORM\Column(type="integer")
     * @Groups({"fr_words_subresource","enWord_read", "frWord_read"})

     */
    private $nbError;

    /**
     * @ORM\ManyToMany(targetEntity=EnWord::class, inversedBy="frWords")
     * @Groups({"frWord_read"})

     */
    private $enWords;

    public function __construct()
    {
        $this->EnWords = new ArrayCollection();
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

    /**
     * @return Collection<int, EnWord>
     */
    public function getEnWords(): Collection
    {
        return $this->enWords;
    }

    public function addEnWord(EnWord $enWord): self
    {
        if (!$this->enWords->contains($enWord)) {
            $this->enWords[] = $enWord;
        }

        return $this;
    }

    public function removeEnWord(EnWord $enWord): self
    {
        $this->enWords->removeElement($enWord);

        return $this;
    }
}
