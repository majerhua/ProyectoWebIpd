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

use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



class IndicadorController extends Controller
{



	public function formIndicadorAction(Request $request){


		$em =  $this->getDoctrine()->getRepository(Indicador::class);;
		
		$indicadores = $em->findAll();


		$form = $this->createForm(IndicadorType::class);

		$indicador = new Indicador();

		$form = $this->createForm(IndicadorType::class,$indicador);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){

			$indicador = $form->getData();

			$em = $this->getDoctrine()->getManager();

			$em->persist($indicador);

			$em->flush();



			return $this->redirectToRoute('prueba_formIndicador');

		}

		return $this->render('PruebaBundle:Indicador:nuevo.html.twig',array("form"=>$form->createView(), "indicadores" => $indicadores ));

	}


	    public function indicadorajaxAction(Request $request)
    {
        $jsonContent=null;

        if($request->isXmlHttpRequest())
        {

            $post = $this->getDoctrine()->getRepository(Indicador::class)->findAll(); 

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

        $post = $this->getDoctrine()->getRepository(Indicador::class)->findAll(); 

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
