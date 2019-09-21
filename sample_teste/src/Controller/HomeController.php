<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController {
    
    /**
     * @Route("/Home", name="home")
     */
    public function index()
    {
        $posts = array(
            [
                'id' => 1,
                'nome' => 'dionathan',
                'data' => '2019-02-02'
            ],
            [
                'id' => 2,
                'nome' => 'Namorada do dionathan',
                'data' => '2019-02-02'
            ]
        );

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'teste' => 'testando como passar o parametro',
            'posts' => $posts
        ]);
    }

    /**
    * @Route("/hello", name="hello")
    */
    public function hello() {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        // 'name' => $name
        ]);
    }

  
    /**
     * @Route("/teste", name="teste")
     */
    public function teste(){
        return new Response('teste');
    }
}
