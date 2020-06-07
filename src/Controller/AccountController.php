<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AccountController
 * @IsGranted("ROLE_USER")
 * @package App\Controller
 */
class AccountController extends BaseController
{
    /**
     * @Route("/account", name="app_account")
     */
    public function index(LoggerInterface $logger)
    {
        $logger->info('Account page for '.$this->getUser()->getEmail(), [
            'user' => $this->getUser()
        ]);

        return $this->render('account/index.html.twig');
    }
}
