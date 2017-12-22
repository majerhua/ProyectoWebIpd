<?php

namespace PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use PruebaBundle\Entity\DetalleIndicador;
use PruebaBundle\Form\DetalleIndicadorType;
use Symfony\Component\HttpFoundation\Request;
use PruebaBundle\Entity\Leyenda;
use PruebaBundle\Form\LeyendaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\JsonResponse;
 
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DetalleIndicadorController extends Controller
{

	public function formDetalleIndicadorAction(Request $request){


		$em =  $this->getDoctrine()->getRepository(DetalleIndicador::class);
		
		$detallesIndicador = $em->findAll();


		$form = $this->createForm(DetalleIndicadorType::class);

		$detalleIndicador = new DetalleIndicador();

		$form = $this->createForm(DetalleIndicadorType::class,$detalleIndicador);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){

			$detalleIndicador = $form->getData();

			$em = $this->getDoctrine()->getManager();

			$em->persist($detalleIndicador);

			$em->flush();



			return $this->redirectToRoute('prueba_formDetalleIndicador');

		}

		return $this->render('PruebaBundle:DetalleIndicador:nuevo.html.twig',array("form"=>$form->createView(), "detallesIndicador" => $detallesIndicador));

	}

	public function verDetalleIndicadorAction(Request $request){


		$eml =  $this->getDoctrine()->getRepository(Leyenda::class);;
		
		$leyendas = $eml->findAll();

		$em =  $this->getDoctrine()->getRepository(DetalleIndicador::class);;
		
		$detallesIndicador = $em->findAll();

		return $this->render('PruebaBundle:DetalleIndicador:ver.html.twig',array("detallesIndicador" => $detallesIndicador, "leyendas" => $leyendas ));

	}


	public function updateDetalleindicadorAction(Request $request, $id) {

		$post = $this->getDoctrine()->getRepository(DetalleIndicador::class)->find($id);

		$atrributes = array('class' => 'form-control' , 'style' => 'margin-bottom:15px');

		$form  = $this->createFormBuilder($post)

		->add('nombre')->add('enero')->add('febrero')->add('marzo')->add('abril')->add('mayo')->add('junio')->add('julio')->add('agosto')->add('septiembre')->add('octubre')->add('noviembre')->add('diciembre')->add('indicador')->add('guardar',SubmitType::class)


		->getForm();

		$form->handleRequest($request);				

        if($form->isSubmitted() && $form->isValid()) {
            $post->setNombre($form['nombre']->getData());
            $post->setEnero($form['enero']->getData());
            $post->setFebrero($form['febrero']->getData());
            $post->setMarzo($form['marzo']->getData());
            $post->setAbril($form['abril']->getData());
            $post->setMayo($form['mayo']->getData());
            $post->setJunio($form['junio']->getData());
            $post->setJulio($form['julio']->getData());
            $post->setAgosto($form['agosto']->getData());
            $post->setSeptiembre($form['septiembre']->getData());
            $post->setOctubre($form['octubre']->getData());
            $post->setNoviembre($form['noviembre']->getData());
            $post->setDiciembre($form['diciembre']->getData());
            $post->setIndicador($form['indicador']->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            
            $this->addFlash('notice', 'Todo updated');
            
            return $this->redirectToRoute('prueba_verDetalleIndicador');
        }

    	return $this->render('PruebaBundle:DetalleIndicador:update.html.twig',array("id" => $id, "form" => $form->createView()) );
    }


    private function createEditForm(DetalleIndicador $detalle_indicador){

    	$form = $this->createForm(DetalleIndicadorType::class,$detalle_indicador);

    }



    public function postsAction(Request $request)
    {
        $jsonContent=null;

        if($request->isXmlHttpRequest())
        {

            $post = $this->getDoctrine()->getRepository(DetalleIndicador::class)->findAll(); 

            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(1);
            // Add Circular reference handler
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($post[0], 'json');




            return new JsonResponse($jsonContent);       
        }

        $post = $this->getDoctrine()->getRepository(DetalleIndicador::class)->findAll(); 

            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(1);
            // Add Circular reference handler
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($post[0], 'json');




    return new JsonResponse($jsonContent);          

    }


    public function graficosAction(Resquest $request){

        $this->render("PruebaBundle:DetalleIndicador:graficos.html.twig");
    }

    public function postTotalAjaxAction(Request $request){

        $jsonContent=null;

        if( $request->isXmlHttpRequest() ){


            $total = $request->request->get('total');

            $post = $this->getDoctrine()->getRepository(DetalleIndicador::class)->findAll(); 

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


            return new JsonResponse($total);   

        }
        $post = $this->getDoctrine()->getRepository(DetalleIndicador::class)->findAll(); 

            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(1);
            // Add Circular reference handler
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($post[0], 'json');




    return new JsonResponse($jsonContent);   

    }



    public function postTotalIndicadorAjaxAction(Request $request){


            if($request->isXmlHttpRequest()){

                $total = $request->request->get(1);

                return new JsonResponse($total); 

            }



    }

}
