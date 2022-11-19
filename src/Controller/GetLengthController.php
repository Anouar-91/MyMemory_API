<?php

namespace App\Controller;


use App\Entity\News;
use App\Repository\NewsRepository;
use App\Repository\EnWordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetLengthController extends AbstractController
{
    private $manager;
    private $newsRepository;

    public function __construct(EntityManagerInterface $entityManager, NewsRepository $newsRepository)
    {
        $this->manager = $entityManager;
        $this->newsRepository = $newsRepository;
    }

    public function __invoke()
    {   
        
        return intval($this->newsRepository->countNews());
    }
}
