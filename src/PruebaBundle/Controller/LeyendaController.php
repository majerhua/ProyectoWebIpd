<?php

namespace PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use PruebaBundle\Entity\Post;
use PruebaBundle\Form\PostType;
use PruebaBundle\Entity\Leyenda;
use PruebaBundle\Entity\Indicador;
use PruebaBundle\Form\LeyendaType;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;




class LeyendaController extends Controller
{

	public function formLeyendaAction(Request $request){
		

		$em =  $this->getDoctrine()->getRepository(Leyenda::class);;
		
		$leyendas = $em->findAll();


		$form = $this->createForm(LeyendaType::class);

		$leyenda = new Leyenda();

		$form = $this->createForm(LeyendaType::class,$leyenda);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){

			$leyenda = $form->getData();

			$em = $this->getDoctrine()->getManager();

			$em->persist($leyenda);

			$em->flush();



			return $this->redirectToRoute('prueba_formLeyenda');

		}

		return $this->render('PruebaBundle:Leyenda:nuevo.html.twig',array("form"=>$form->createView(), "leyendas" => $leyendas));

	}


	public function ajaxLeyendaAction(Request $request){


		return $this->render("PruebaBundle:Leyenda:pruebaajax.html.twig");

	}

	public function postLeyendaAjaxAction(Request $request){


		if($request->isXmlHttpRequest()){

			$amarillo = $request->request->get('amarillo');
			$indicadores = $request->request->get('indicadores');
			$rojo = $request->request->get('rojo');
			$verde = $request->request->get('verde');

    		$leyendaFila = new Leyenda();
			$leyendaFila->setAmarillo($amarillo);
			$leyendaFila->setVerde($verde);
			$leyendaFila->setRojo($rojo);

			$em =  $this->getDoctrine()->getRepository(Indicador::class);
		
			$indicadorN = $em->find($indicadores);

			$leyendaFila->setIndicador($indicadorN);

			$em = $this->getDoctrine()->getManager();

			$em->persist($leyendaFila);

			$em->flush();



			$em =  $this->getDoctrine()->getRepository(Leyenda::class);
		
			$leyendaAll = $em->findAll();


            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(1);
            // Add Circular reference handler
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($leyendaAll, 'json');


            return new JsonResponse($jsonContent);
		}

		

	}



	public function getLeyendaAjaxAction(Request $request){


		if($request->isXmlHttpRequest()){

			$em =  $this->getDoctrine()->getRepository(Leyenda::class);
			
			$leyendaAll = $em->findAll();

            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(1);
            // Add Circular reference handler
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($leyendaAll, 'json');


            return new JsonResponse($jsonContent);

			}
	}


}
