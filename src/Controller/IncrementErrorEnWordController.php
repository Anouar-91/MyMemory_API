<?php

namespace App\Controller;

use App\Entity\EnWord;
use App\Entity\FrWord;
use App\Entity\AddEnFrService;
use App\Repository\EnWordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Exceptions\WordAlreadyExistException;

class IncrementErrorEnWordController extends AbstractController
{
    private $manager;
    private $enRepository;

    public function __construct(EntityManagerInterface $entityManager, EnWordRepository $enRepository)
    {   
        $this->manager = $entityManager;
        $this->enRepository = $enRepository;
    }


    public function __invoke(EnWord $data): EnWord
 {
    $data->setNbError($data->getNbError() + 1);
    $this->manager->persist($data);
    $this->manager->flush();
    return $data ;
}
}
