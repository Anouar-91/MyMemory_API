<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EnWordRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiSubresource;


/**
 * @ApiResource(
 * normalizationContext={
 *      "groups"={"enWord_read"}
 * },
 *     collectionOperations={
 *          "POST",
 *          "GET",
 *      },
 * )
 * @ORM\Entity(repositoryClass=EnWordRepository::class)
 */
class EnWord
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
     * @Assert\NotBlank(message="Content is required !")
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
     * @ORM\OneToMany(targetEntity=FrWord::class, mappedBy="enWord")
     * @Groups({"enWord_read"})
     */
    private $frWords;


    

  


    public function __construct()
    {
        $this->frWords = new ArrayCollection();
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
     * @return Collection<int, FrWord>
     */
    public function getFrWords(): Collection
    {
        return $this->frWords;
    }

    public function addFrWord(FrWord $frWord): self
    {
        if (!$this->frWords->contains($frWord)) {
            $this->frWords[] = $frWord;
            $frWord->setEnWord($this);
        }

        return $this;
    }

    public function removeFrWord(FrWord $frWord): self
    {
        if ($this->frWords->removeElement($frWord)) {
            // set the owning side to null (unless already changed)
            if ($frWord->getEnWord() === $this) {
                $frWord->setEnWord(null);
            }
        }

        return $this;
    }


}
