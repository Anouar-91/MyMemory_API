<?php

namespace App\Controller;

use App\Entity\EnWord;
use App\Entity\FrWord;
use App\Entity\AddEnFrService;
use App\Repository\EnWordRepository;
use App\Entity\IncrementResultService;
use Doctrine\ORM\EntityManagerInterface;
use App\Exceptions\WordAlreadyExistException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IncrementErrorAllEnWord extends AbstractController
{
    private $manager;
    private $enRepository;

    public function __construct(EntityManagerInterface $entityManager, EnWordRepository $enRepository)
    {   
        $this->manager = $entityManager;
        $this->enRepository = $enRepository;
    }


    public function __invoke(IncrementResultService $data)
 {
    $enWordTab = [];
    foreach($data->enWords as $id){
        $enWord = $this->enRepository->find($id);
        $enWord->setNbError($enWord->getNbError() + 1);
        array_push($enWordTab, $enWord);
        $this->manager->persist($enWord);
    }
    $this->manager->flush();
    $response = $this->json($enWordTab, 200, [] );
    return $response;


}
}
