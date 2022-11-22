<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EnWordRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;


/**
 * @ApiResource(
 * attributes={"pagination_enabled"=false},
 * normalizationContext={
 *      "groups"={"enWord_read"}
 * },
 *     collectionOperations={
 *          "POST",
 *          "GET",
 *          "lowSuccess"={
 *          "method"="GET",
 *          "path"="/en_words/low-success",
 *          "controller"="App\Controller\LowSuccessController"
 *      }},
 * itemOperations={
 *      "GET",
 *      "PUT",
 *      "DELETE",
 *      "INCREMENT"={
 *          "method"="POST",
 *          "path"="/en_words/{id}/increment",
 *          "controller"="App\Controller\IncrementErrorEnWordController"
 *      }
 * },
 * )
 * @ApiFilter(OrderFilter::class, properties={"createdAt": "DESC"})
 * @ORM\Entity(repositoryClass=EnWordRepository::class)
 */
class EnWord
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"enWord_read", "frWord_read", "news_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Content is required !")
     * @Groups({"enWord_read", "frWord_read", "news_read"})

     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"enWord_read", "frWord_read", "news_read"})

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
     * @Groups({"enWord_read", "news_read"})
     */
    private $frWords;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"enWord_read", "frWord_read"})
     */
    private $nbSuccess;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="enWords")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=News::class, mappedBy="enWord")
     */
    private $news;


    

  


    public function __construct()
    {
        $this->frWords = new ArrayCollection();
        $this->nbError = 0;
        $this->nbSuccess = 0;
        $this->createdAt = new \DateTime();
        $this->news = new ArrayCollection();
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

    public function getNbSuccess(): ?int
    {
        return $this->nbSuccess;
    }

    public function setNbSuccess(int $nbSuccess): self
    {
        $this->nbSuccess = $nbSuccess;

        return $this;
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

    /**
     * @return Collection<int, News>
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
            $news->setEnWord($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->removeElement($news)) {
            // set the owning side to null (unless already changed)
            if ($news->getEnWord() === $this) {
                $news->setEnWord(null);
            }
        }

        return $this;
    }


}
