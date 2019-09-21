<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use App\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserController extends AbstractController
{
    /**
    * @Route("/users", name="users")
    */
    public function index()
    {

        // $users = array(
        //     [
        //         'id' => 1,
        //         'nome' => 'dionathan',
        //         'email' => 'dntcordova@hotmai.com'
        //     ],
        //     [
        //         'id' => 2,
        //         'nome' => 'Namorada do dionathan',
        //         'email' => 'linda@hotmai.com'
        //     ]
        // );

        $users = $this->getDoctrine()->getRepository(Users::class)->findAll();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users' => $users
        ]);
    }

     /**
    * @Route("create/", name="user-create")W
    */
    public function create()
    {
        return $this->render('user/create.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

     /**
    * @Route("save/", name="user-save")W
    * @Method({"POST"})
    */
    public function save(Request $request) {
        $data = $request->request->all();

        $query = $em->createQuery('SELECT u FROM MyProject\Model\User u WHERE u.age > 20');
        $users = $query->getResult();

        $user = new Users();
        $user->setEmail($data['email']);
        $user->setPassword(addslashes(sha1($data['senha'])));
        $user->setCreatedAt(new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')));
        $user->setUpdatedAt(new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')));

        $doctrine = $this->getDoctrine()->getManager();
        // INICIAR A PERSISTENCIA DO METODO NO BANCO
        $doctrine->persist($user);
        // EXECUTAR A OPERAÇÂO
        $doctrine->flush();

        if($user->getId()) {
            $response = '200';
        }else{
            $response = '404';
        }
        return new Response(json_encode($response . '- id: ' . $user->getId()));
    }

    /**
    * @Route("userView/{param}", name="userView")W
    * @Method({"POST"})
    */
    public function userView($param) {
        $user = $this->getDoctrine()->getRepository(Users::class)->find($param);

        return $this->render('user/userView.html.twig', [
            'controller_name' => 'UserController',
            'user'=>$user,
        ]);
    }

     /**
    * @Route("userEdit/{param}", name="userEdit")W
    * @Method({"POST"})
    */
    public function userEdit(Request $request, $param) {
        $data = $request->request->all();
        $user = $this->getDoctrine()->getRepository(Users::class)->find($param);
        $user->setNome($data['nome']);
        $user->setEmail($data['email']);
        $user->setPassword(addslashes(sha1($data['senha'])));
        $user->setCreatedAt(new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')));
        $user->setUpdatedAt(new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')));

        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->flush();

        if($user->getId()) {
            $response = '200';
        }else{
            $response = '404';
        }
        return new Response(json_encode($response . '- id: ' . $user->getId()));
    }
  
    /**
    * @Route("userDelete/{param}", name="userDelete")W
    * @Method({"DELETE"})
    */
    public function userDelete(Request $request, $param) {
        $user = $this->getDoctrine()->getRepository(Users::class)->find($param);
        
        $doctrine = $this->getDoctrine()->getManager();
        // INICIAR A PERSISTENCIA DO METODO NO BANCO
        $doctrine->remove($user);
        // EXECUTAR A OPERAÇÂO
        $doctrine->flush();

        return new Response(json_encode($param));
    }
}
