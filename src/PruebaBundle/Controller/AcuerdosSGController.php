<?php

namespace PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use PruebaBundle\Entity\AcuerdosSG;
use PruebaBundle\Entity\AreaIpd;
use PruebaBundle\Entity\ObservacionesSG;


class AcuerdosSGController extends Controller
{

	public function acuerdosSGAction(Request $request)
    {
    
    	return $this->render('PruebaBundle:AcuerdosSG:acuerdosSG.html.twig');

    }

	public function acuerdosSGPostAction(Request $request)
    {
    
		if($request->isXmlHttpRequest()){

			

			$sesion = $request->request->get('sesion'); 
			$fecha = $request->request->get('fecha');
			$agenda = $request->request->get('agenda');
			$acuerdos = $request->request->get('acuerdos');
			$areaIpd = $request->request->get('areaIpd');
			$estado = $request->request->get('estado'); 
			$observaciones = $request->request->get('observaciones');
			$plazoEntrega = $request->request->get('plazoEntrega');


			$hoy = date("Y-m-d");
			
			$acuerdosSG = new AcuerdosSG();

			$acuerdosSG->setSesion($sesion);
			$acuerdosSG->setFecha($fecha);
			$acuerdosSG->setAgenda($agenda);
			$acuerdosSG->setAcuerdos($acuerdos);
            $em =  $this->getDoctrine()->getRepository(AreaIpd::class);
        	$areaIpdN = $em->find($areaIpd);
        	$acuerdosSG->setAreaIpd($areaIpdN);
			$acuerdosSG->setEstado($estado);
			$acuerdosSG->setPlazoEntrega($plazoEntrega);

			$em = $this->getDoctrine()->getManager();
        	$em->persist($acuerdosSG);
        	$em->flush();


        	$id_acuerdosSG=$acuerdosSG->getId();


        	$observacionesSG = new ObservacionesSG();

        	$observacionesSG->setDescripcion($observaciones);
        	$observacionesSG->setFecha($hoy);
            $em =  $this->getDoctrine()->getRepository(AcuerdosSG::class);
        	$acuerdosSGN = $em->find($id_acuerdosSG);
        	$observacionesSG->setAcuerdoSG($acuerdosSGN);

			$em = $this->getDoctrine()->getManager();
        	$em->persist($observacionesSG);
        	$em->flush();


            $em =  $this->getDoctrine()->getRepository(AcuerdosSG::class);
        	$acuerdosSGAll = $em->findAll();


            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(1);
            // Add Circular reference handler
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($acuerdosSGAll, 'json');


			return new JsonResponse($jsonContent);

		}    	


    }


	public function acuerdosSGGetAction(Request $request){

		$em =  $this->getDoctrine()->getRepository(AcuerdosSG::class);
    	$acuerdosSGAll = $em->findAll();


        $encoders = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        // Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($acuerdosSGAll, 'json');


		return new JsonResponse($jsonContent);

	}
    

}
