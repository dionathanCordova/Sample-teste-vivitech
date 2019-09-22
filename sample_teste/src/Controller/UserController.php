<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use App\Entity\Users;
use Symfony\Component\Routing\RequestContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserController extends AbstractController
{
    /**
    * @Route("/users", name="users")
    */
    public function index()
    {

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
        $email = $data['email'];
        $query2 = $this->getDoctrine()->getManager();
        $query = $query2->createQuery("SELECT u.email FROM App\Entity\Users u WHERE u.email = '$email'");
        $users = $query->getResult();

        if(count($users) > 0) {
            $response = ' Este email já possui usuário vinculado, por favor selecione outro email!';
            return new Response(json_encode($response));
        }else{
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
            return new Response(json_encode($response));
        }
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

        $email = $data['email'];
        $query2 = $this->getDoctrine()->getManager();
        $query = $query2->createQuery("SELECT u.email FROM App\Entity\Users u WHERE u.email = '$email' AND u.id != $param ");
        $users = $query->getResult();

        if(count($users) > 0) {
            $response = ' Este email já possui usuário vinculado, por favor selecione outro email!';
            return new Response(json_encode($response));
        }else{
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
            return new Response(json_encode($response));
        }
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

     /**
    * @Route("setAvatar/", name="setAvatar")W
    * @Method({"DELETE"})
    */
    public function setAvatar(Request $request) {
        // PEGANDO A BASE URL PARA ENCONTRAR O ARQUIVO COM O JAVASCRIPT
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        $url = $protocol . "://" . $_SERVER['HTTP_HOST'] .'/';

        $filename = $_FILES['file']['name'];

        /* Location */
        $location = "upload/". date('H-i-s') .$filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

        /* Valid Extensions */
        $valid_extensions = array("jpg","jpeg","png");
        /* Check file extension */
        if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
            $uploadOk = 0;
        }

        if($uploadOk == 0){
            return new Response(json_encode(0));
        }else{
            /* Upload file */
            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                $data = $request->request->all();
                $id = $data['id_user'];

                $query = $this->getDoctrine()->getManager();
                $query = $query->createQuery("UPDATE App\Entity\Users u SET u.avatar = '$location' WHERE u.id = $id");
                $users = $query->getResult();

                return new Response(json_encode(['response' => $url . $location, 'filename' => 'teste']));
            }else{
                return new Response(json_encode(0));
            }
        }
    }
}
