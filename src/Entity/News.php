<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ApiResource(
 * 
 * normalizationContext={
 *      "groups"={"news_read"}
 * },
 *     collectionOperations={
 *          "GET",
 *      },
 *     itemOperations={
 *         "GET"={
 *             "method"="GET",
 *             "controller"=NotFoundAction::class,
 *             "read"=false,
 *             "output"=false,
 *         },
 *     },
 * )
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 */
class News
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"news_read"})

     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=EnWord::class, inversedBy="news")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"news_read"})

     */
    private $enWord;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="news")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"news_read"})

     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"news_read"})

     */
    private $createdAt;

    public function __construct(){
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
}
