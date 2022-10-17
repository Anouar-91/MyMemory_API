<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EnWordRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(
 *      collectionOperations={
 *          "POST"={
 *          "method"="POST",
 *          "path"="/en_fr_words/add",
 *          "controller"="App\Controller\AddEnWordController"
 *      },
 *      },
 * itemOperations={},
 * )
 * 
 */
class AddEnFrService
{


    /**
     * @Assert\NotBlank(message="frWord is required !")

     */
    public $frWord;

    /**
     * @Assert\NotBlank(message="enWord is required !")

     */
    public $enWord;


    

  



}
