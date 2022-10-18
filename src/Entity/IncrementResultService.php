<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\IncrementErrorServiceRepository;

/**
 * @ApiResource(
*      collectionOperations={
*          "ERROR"={
*          "method"="POST",
*          "path"="/en_words_increment/error",
*          "controller"="App\Controller\IncrementErrorAllEnWord",
*           "status"=200
*      },
*          "SUCCESS"={
*          "method"="POST",
*          "path"="/en_words_increment/success",
*          "controller"="App\Controller\IncrementSuccessAllEnWord",
*           "status"=200
*      },
*      },
* itemOperations={},
* )
*/
class IncrementResultService
{


    public $enWords;
}
