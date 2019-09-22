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
                'nome' => 'Qualquer serviço de Repositorio / Versionamentoathan',
                'done' => 'Github - https://github.com/dionathanCordova/Sample-teste-vivitech'
            ],
            [
                'id' => 2,
                'nome' => 'Usar o Framework Symfony 2 ou Superior',
                'done' => 'Aplicação utilizando Symfony 4.'
            ],
            [
                'id' => 3,
                'nome' => 'Deve conter uma ou mais Actions no Frontend e no BackEnd',
                'done' => 'Aplicação possui 1 metodo controller e 1 action relacionados ao controller HomeController e 7 metodos e 3 actions relacionados ao controller UserControlller.'
            ],
            [
                'id' => 4,
                'nome' => 'Use Doctrine pelo Symfony eles se dão muito bem, chame o amigo Mysql para participar.',
                'done' => 'Desde a criação do banco de dados, até o Crud que a aplicação utiliza, está sendo feito com o Doctrine e Mysql.'
            ],
            [
                'id' => 5,
                'nome' => 'Usar Twig ou algo similar que trabalhe com template enginer.',
                'done' => 'Embora tenha sido usado somente o básico, a aplicação utiliza Twig em todas as Views.'
            ],
            [
                'id' => 6,
                'nome' => 'Saber alguma coisa de micro serviços: Docker, Lambda, Docker-compose e afins (Mostre-nos o que voce sabe).',
                'done' => 'Sei somente o básico da teoria sobre Docker, mas tenho uma meta de logo começar a utilizar esta tecnologia.'
            ],
            [
                'id' => 7,
                'nome' => 'CSS/JS framework como Bootstrap/UIKit.',
                'done' => 'O Navbar, tabela de usuários cadastrados e os formulários foram feitos com bootstrap.'
            ],
            [
                'id' => 8,
                'nome' => 'PHPUnit Test ou Selenium.',
                'done' => 'Me impuz a meta de entregar o maximo possível até a data 23/09/2019. então não foi possível estudar e agregar nada de TDD na aplicação.'
            ]
        );

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'teste' => 'testando como passar o parametro',
            'posts' => $posts
        ]);
    }
}
