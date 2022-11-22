<?php

namespace App\Controller;


use App\Repository\NewsRepository;
use App\Repository\EnWordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class LowSuccessController extends AbstractController
{
    private $manager;
    private $enWordRepository;

    public function __construct(EntityManagerInterface $entityManager, EnWordRepository $enWordRepository)
    {
        $this->manager = $entityManager;
        $this->enWordRepository = $enWordRepository;
    }

    public function __invoke(Request $request): Array
    {   
        
        $limit = $request->get('limit') ? $request->get('limit') : null ;
        $enWords = $this->enWordRepository->findBy([], ["nbSuccess" => "ASC"], $limit);

        return $enWords;
    }
}
