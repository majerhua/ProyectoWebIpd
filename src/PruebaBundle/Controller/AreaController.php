<?php

namespace PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PruebaBundle\Entity\AreaIpd;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class AreaController extends Controller
{

    public function getAreaAction(Request $request)
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


            return new JsonResponse("javier");
     
    }


/* INICIO RESPONSABLE ACUERDO */

    public function responsableAcuerdoAction(Request $request){
        
        $responsablesAcuerdo = $this->getDoctrine()->getRepository(AreaIpd::class)->findAll();

        return $this->render('PruebaBundle:Area:area.html.twig', array("responsablesAcuerdo" => $responsablesAcuerdo));

    }

    public function responsableAcuerdoNuevoAction(Request $request){

        if($request->isXmlHttpRequest()){

            $nombre = $request->request->get('nombre');
            $personaResponsable = $request->request->get('personaReponsable');
            $correo = $request->request->get('correo');
            $tipo = $request->request->get('tipo');

            $areaResponsable = new AreaIpd();

            $areaResponsable->setNombre($nombre);
            $areaResponsable->setCorreo($correo);
            $areaResponsable->setPersonaResponsable($personaResponsable);
            $areaResponsable->setTipo($tipo);
            $areaResponsable->setBaja('1');

            $em = $this->getDoctrine()->getManager();
            $em->persist($areaResponsable);
            $em->flush();

            return new JsonResponse("1");
        }

        return $this->render('PruebaBundle:Area:nuevo.html.twig');   

    }

    public function responsableAcuerdoUpdateAction(Request $request, $id){

        
        if($request->isXmlHttpRequest()){
            $areaResponsable= $this->getDoctrine()->getRepository(AreaIpd::class)->find($id);
            $nombre = $request->request->get('nombre');
            $personaResponsable = $request->request->get('personaReponsable');
            $correo = $request->request->get('correo');
            $areaResponsable->setNombre($nombre);
            $areaResponsable->setCorreo($correo);
            $areaResponsable->setPersonaResponsable($personaResponsable);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return new JsonResponse("1");
        }
        $areaResponsable= $this->getDoctrine()->getRepository(AreaIpd::class)->find($id);
        return $this->render('PruebaBundle:Area:update.html.twig', array("areaResponsable" => $areaResponsable));   

    }

    public function responsableAcuerdoRemoveAction(Request $request, $id){

        
        if($request->isXmlHttpRequest()){
            $areaResponsable= $this->getDoctrine()->getRepository(AreaIpd::class)->find($id);
            $baja = $request->request->get('baja');
            $areaResponsable->setBaja($baja);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new JsonResponse("1");
        }

        $areaResponsable= $this->getDoctrine()->getRepository(AreaIpd::class)->find($id);
        return $this->render('PruebaBundle:Area:remove.html.twig', array("id" => $id));   
    }

/* FIN RESPONSABLE ACUERDO */

}
