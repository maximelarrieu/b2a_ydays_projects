<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    public function base()
    {
        return $this->render('base.html.twig', [
        ]);
    }

    public function home()
    {
        $number = random_int(0, 100);
        return $this->render('home.html.twig', [
            'lucky' => $number
        ]);
    }

    public function name(string $name) {
        return $this->render('name.html.twig', [
            'name' => $name
        ]);
    }
}