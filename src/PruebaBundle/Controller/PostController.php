<?php

namespace PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use PruebaBundle\Entity\Post;
use PruebaBundle\Form\PostType;
use PruebaBundle\Entity\Indicador;
use PruebaBundle\Form\IndicadorType;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{


	public function insertPostAction(){

		$post = new Post();
		$post->setTitulo('Top Framework PHP 2017');
		$post->setContenido('Symfony es el framework mas poderoso');
		$post->setAutor('Carlos Javier Majerhua Nuñez');
		$post->setFecha(new \DateTime('2017-12-14'));

		$em = $this->getDoctrine()->getManager();

		$em->persist($post);

		$em->flush();

		return new Response('Se inserto nueva entrada con Id: '.$post->getId());

	}


	public function formPostAction(Request $request){

		$form = $this->createForm(PostType::class);

		$post = new Post();

		$form = $this->createForm(PostType::class,$post);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){

			$post = $form->getData();

			$em = $this->getDoctrine()->getManager();

			$em->persist($post);

			$em->flush();



			return $this->redirectToRoute('prueba_form');

		}

		return $this->render('PruebaBundle:Post:nuevo.html.twig',array("form"=>$form->createView() ));

	}




	public function mostrarPostAction(){


		$em =  $this->getDoctrine()->getRepository(Post::class);;
		
		$posts = $em->findAll();
		dump($posts);

		return new Response('Datos Tabla Post');
	}

}
