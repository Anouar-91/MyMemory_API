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

class AddEnWordController extends AbstractController
{
    private $manager;
    private $enRepository;

    public function __construct(EntityManagerInterface $entityManager, EnWordRepository $enRepository)
    {   
        $this->manager = $entityManager;
        $this->enRepository = $enRepository;
    }


    public function __invoke(AddEnFrService $data): EnWord
 {

        $isExist = $this->enRepository->findOneBy(['content' => $data->enWord]);
        
        if($isExist){
            throw new WordAlreadyExistException("This word already exist !");
        }
        else{
            $enWord = new EnWord();
            $frWord = new FrWord();
            $frWord->setContent($data->frWord);
            $this->manager->persist($frWord);
            $enWord->setContent($data->enWord);
            $enWord->addFrWord($frWord);
            $this->manager->persist($enWord);
            $this->manager->flush();
            return $enWord;
        }
    }
}