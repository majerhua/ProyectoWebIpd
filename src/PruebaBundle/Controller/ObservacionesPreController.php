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

class ObservacionesPreController extends Controller
{


	public function observacionesPrePostAction(Request $request){

		$id = $request->request->get("id");

		$em =  $this->getDoctrine()->getRepository(AcuerdosPre::class);
		$acuerdosPre = $em->find($id);


	    $encoders = array(new JsonEncoder());
	    $normalizer = new ObjectNormalizer();
	    $normalizer->setCircularReferenceLimit(1);
	    // Add Circular reference handler
	    $normalizer->setCircularReferenceHandler(function ($object) {
	        return $object->getId();
	    });
	    $normalizers = array($normalizer);
	    $serializer = new Serializer($normalizers, $encoders);

	    $jsonContent = $serializer->serialize($acuerdosPre, 'json');


		return new JsonResponse($jsonContent);

	}

}
