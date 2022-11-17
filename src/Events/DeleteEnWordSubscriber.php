<?php 

namespace App\Events;

use App\Entity\User;
use App\Entity\EnWord;
use App\Repository\NewsRepository;
use App\Repository\FrWordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class DeleteEnWordSubscriber implements EventSubscriberInterface{
    
    protected $frRepository;
    protected $manager;
    protected $newsRepository;
    public function __construct( FrWordRepository $frRepository, EntityManagerInterface $entityManager, NewsRepository $newsRepository){
        $this->manager = $entityManager;
        $this->frRepository = $frRepository;
        $this->newsRepository = $newsRepository;
    }
    public static function getSubscribedEvents(){
        //on se retrouve au moment ou API PLAFORM a fini de désérialiser le JSON et il s'apprête à l'envoyer à la base de données
        return [
            KernelEvents::VIEW => ['deleteFrWords', EventPriorities::PRE_WRITE]
        ];
    }

    public function deleteFrWords(ViewEvent $event){

        $result = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
     
        if($result instanceof EnWord && $method === "DELETE"){
            $frWords = $this->frRepository->findBy(["enWord" => $result]);
            $news = $this->newsRepository->findOneBy(["enWord" => $result]);
            if($news){
                $this->manager->remove($news);
            }
            foreach($frWords as $frWord){
                $this->manager->remove($frWord);
            }

            $this->manager->flush();
/*             $hash = $this->encoder->hashPassword($result, $result->getPassword());
            $result->setPassword($hash); */
            
        }
    }
}