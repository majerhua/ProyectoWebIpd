<?php

namespace PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PruebaBundle\Form\UserType;
use PruebaBundle\Entity\User;
use PruebaBundle\Entity\AreaIpd;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class DefaultController extends Controller
{
	
    public function indexAction()
    {
        return $this->render('PruebaBundle:Default:index.html.twig');
    }


    public function nombreAction($nPila){

    	return $this->render('PruebaBundle:Default:nombre.html.twig',array('nPila'=>$nPila));
    }


    /**
     * @Route("/usuarios", name="usuarios")
     */
    public function usuariosAction(Request $request)
    {
        return $this->render('PruebaBundle:Default:index.html.twig');
    }




    public function postuserjaxAction(Request $request)
    {
        $jsonContent=null;

        if($request->isXmlHttpRequest())
        {

             


            $areaIpd = $request->request->get('areaIpd');
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            $plainpassword = $request->request->get('plainpassword');
            $username = $request->request->get('username');
            $roles = $request->request->get("roles");

            if( $password == $plainpassword  ){

                $post = $this->getDoctrine()->getRepository(AreaIpd::class)->findAll();
                
                $user = new User();

                $user->setPlainPassword($plainpassword);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setUsername($username);


                $em =  $this->getDoctrine()->getRepository(AreaIpd::class);
                $areaIpdN = $em->find($areaIpd);
                $user->setAreaIpd($areaIpdN);

                $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);


                if($roles == "0" ){
                    $roles = ["ROLE_USER"];
                                       
                }else{
                    $roles = ["ROLE_ADMIN"];
                                      
                }

                $user->setRoles($roles);  

                // 4) save the User!
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return new JsonResponse("Datos Correctos");


            }else{
                return new JsonResponse("Invalid Password");
            }

            

        }
     
    }



     

    public function getareajaxAction(Request $request)
    {
        $jsonContent=null;

        if($request->isXmlHttpRequest())
        {

            $post = $this->getDoctrine()->getRepository(AreaIpd::class)->findAll(); 

            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(1);
            // Add Circular reference handler
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($post, 'json');


            return new JsonResponse($jsonContent);  

        }
     
    }


    public function loginAction(Request $request){

            // get the login error if there is one
    $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('PruebaBundle:Default:login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));

    }

    public function registerAction(Request $request)
    {
        // 1) build the form

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);


           $roles = ["ROLE_USER"];
            $user->setRoles($roles);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('prueba_register');
        }

        return $this->render('PruebaBundle:Default:register.html.twig',
            array('form' => $form->createView())
        );
    }

}
