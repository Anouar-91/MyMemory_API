<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\EnWord;
use App\Entity\FrWord;
use App\Entity\AddEnFrService;
use App\Repository\EnWordRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Exceptions\WordAlreadyExistException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

        $isExist = $this->enRepository->findOneBy(['content' => $data->enWord, 'user' => $this->getUser()]);
        
        if($isExist){
            throw new WordAlreadyExistException("This word already exist !");
        }
        else{
          
            $enWord = new EnWord();
            $frWord = new FrWord();
            $frWord->setContent($data->frWord);
            $enWord->setContent($data->enWord);
            $enWord->addFrWord($frWord);
            $enWord->setUser($this->getUser());
            if($data->isShare === true){
                $new = new News();
                $new->setEnWord($enWord);
                $new->setUser($this->getUser());
                $this->manager->persist($new);
            }
            if($data->frDescription and trim($data->frDescription) != ""){
                $frWord->setDescription($data->frDescription);
            }
            if($data->enDescription and trim($data->enDescription) != ""){
                $enWord->setDescription($data->enDescription);
            }
            $this->manager->persist($frWord);
            $this->manager->persist($enWord);

            $this->manager->flush();
            return $enWord;
        }
    }
}
