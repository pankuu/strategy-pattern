<?php


namespace App\Controller;


use App\Entity\User;
use App\Service\Context;
use App\Service\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        $this->context->handle($users);

        return $this->render('main/homepage.html.twig' );
    }
}