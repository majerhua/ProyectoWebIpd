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

use PruebaBundle\Entity\AcuerdosPre;
use PruebaBundle\Entity\AreaIpd;
use PruebaBundle\Entity\ObservacionesPre;

class AcuerdosPreController extends Controller
{


	public function acuerdosPreAction(Request $request)
    {
    
    	return $this->render('PruebaBundle:AcuerdosPre:acuerdosPre.html.twig');

    }

	public function acuerdosPrePostAction(Request $request)
    {
    
		if($request->isXmlHttpRequest()){

			

			$comite = $request->request->get('comite'); 
			$fecha = $request->request->get('fecha');
			$acuerdos = $request->request->get('acuerdos');
			$nroAcuerdo = $request->request->get('nroAcuerdo');
			$areaIpd = $request->request->get('areaIpd');
			$estado = $request->request->get('estado'); 
			$observaciones = $request->request->get('observaciones');
			$plazoEntrega = $request->request->get('plazoEntrega');


			$hoy = date("Y-m-d");
			
			$acuerdosPre = new AcuerdosPre();

			$acuerdosPre->setComite($comite);
			$acuerdosPre->setFecha($fecha);
			$acuerdosPre->setAcuerdos($acuerdos);
			$acuerdosPre->setNroAcuerdo($nroAcuerdo);
            $em =  $this->getDoctrine()->getRepository(AreaIpd::class);
        	$areaIpdN = $em->find($areaIpd);
        	$acuerdosPre->setAreaIpd($areaIpdN);
			$acuerdosPre->setEstado($estado);
			$acuerdosPre->setPlazoEntrega($plazoEntrega);

			$em = $this->getDoctrine()->getManager();
        	$em->persist($acuerdosPre);
        	$em->flush();


        	$id_acuerdosPre=$acuerdosPre->getId();


        	$observacionesPre = new ObservacionesPre();

        	$observacionesPre->setDescripcion($observaciones);
        	$observacionesPre->setFecha($hoy);
            $em =  $this->getDoctrine()->getRepository(AcuerdosPre::class);
        	$acuerdosPreN = $em->find($id_acuerdosPre);
        	$observacionesPre->setAcuerdoPre($acuerdosPreN);

			$em = $this->getDoctrine()->getManager();
        	$em->persist($observacionesPre);
        	$em->flush();


            $em =  $this->getDoctrine()->getRepository(AcuerdosPre::class);
        	$acuerdosPreAll = $em->findAll();


            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(1);
            // Add Circular reference handler
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($acuerdosPreAll, 'json');


			return new JsonResponse($jsonContent);

		}    	


    }


	public function acuerdosPreGetAction(Request $request){

		$em =  $this->getDoctrine()->getRepository(AcuerdosPre::class);
    	$acuerdosPreAll = $em->findAll();


        $encoders = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        // Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($acuerdosPreAll, 'json');


		return new JsonResponse($jsonContent);

	}
    

    
}
