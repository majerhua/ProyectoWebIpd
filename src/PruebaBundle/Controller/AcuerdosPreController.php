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
use PruebaBundle\Entity\AcuerdosPreAreaIpd;

class AcuerdosPreController extends Controller
{
	public function acuerdosPreAction(Request $request)
    {

        $enProceso = 'En Proceso';
        $implementado = 'Implementado';
        $cancelado = 'Cancelado';

        $em = $this->getDoctrine()->getManager();

        $mdlCantidadEnProceso = $em->getRepository('PruebaBundle:AcuerdosPre')->getCantidadEstadoPre($enProceso);
        $mdlCantidadImplementado = $em->getRepository('PruebaBundle:AcuerdosPre')->getCantidadEstadoPre($implementado);
        $mdlCantidadCancelado = $em->getRepository('PruebaBundle:AcuerdosPre')->getCantidadEstadoPre($cancelado);
        $mdlCantidadPre = $em->getRepository('PruebaBundle:AcuerdosPre')->getCantidadPre();

        $acuerdosPreAreaIpd =  $this->getDoctrine()->getRepository(AcuerdosPre::class)->findAll();
        $acuerdosPreAreaIpd =  $this->getDoctrine()->getRepository(AreaIpd::class)->findAll();
        $acuerdosPreAreaIpd =  $this->getDoctrine()->getRepository(AcuerdosPreAreaIpd::class)->findAll();

        return $this->render('PruebaBundle:AcuerdosPre:acuerdosPre.html.twig', array( 'cantidadEnProceso' => $mdlCantidadEnProceso , 'cantidadImplementado' => $mdlCantidadImplementado, 'cantidadCancelado' => $mdlCantidadCancelado, 'cantidadPre' => $mdlCantidadPre, "acuerdosPreAreaIpd" => $acuerdosPreAreaIpd));
    }

    public function acuerdosPreUpdateAction(Request $request, $id){

        if($request->isXmlHttpRequest()){

            $comite = $request->request->get('comite'); 
            $fecha = $request->request->get('fecha');
            $acuerdos = $request->request->get('acuerdos');
            $nroAcuerdo = $request->request->get('nroAcuerdo');
            $areaIpd = $request->request->get('areaIpd');
            $areasIpdInicio = $request->request->get('areasIpdInicio');
            $estado = $request->request->get('estado'); 
            $observaciones = $request->request->get('observaciones');
            $plazoEntrega = $request->request->get('plazoEntrega');

            $hoy = date("Y-m-d");
            $em_ap = $this->getDoctrine()->getManager();
            $acuerdosPre = $em_ap->getRepository(AcuerdosPre::class)->find($id);

            $acuerdosPre->setComite($comite);
            $acuerdosPre->setFecha($fecha);
            $acuerdosPre->setAcuerdos($acuerdos);
            $acuerdosPre->setNroAcuerdo($nroAcuerdo);
            $acuerdosPre->setEstado($estado);
            $acuerdosPre->setPlazoEntrega($plazoEntrega);

            $em_ap->flush();

            $id_acuerdosPre=$acuerdosPre->getId();
            $latestObservacion = $acuerdosPre->getObservacionPre()[count($acuerdosPre->getObservacionPre())-1];

            if($observaciones != $latestObservacion->getDescripcion()){

                $observacionesPre = new ObservacionesPre();
                $hoy = date("Y-m-d");
                $observacionesSG->setDescripcion($observaciones);
                $observacionesSG->setFecha($hoy);
                //SE REALIZA LA BUSQUEDA DEL ULTIMO ACUERDO SG INGRESADO
                $em =  $this->getDoctrine()->getRepository(AcuerdosPre::class);
                $acuerdosPreN = $em->find($id_acuerdosPre);
                //SE ASIGNA EL ULTIMO ACUERDO INGRESADO POR AJAX AL OBJETO OBSERVACIONESSG
                $observacionesPre->setAcuerdoSG($acuerdosPreN);
                //SE GUARDA EN LA BASE DE DATOS
                $em = $this->getDoctrine()->getManager();
                $em->persist($observacionesPre);
                $em->flush();
            }

            if(count($areaIpd) >= count($areasIpdInicio)){

                for ($i=0; $i < count($areaIpd) ; $i++) { 

                    $em = $this->getDoctrine()->getManager();
                    if($i < count($areasIpdInicio)){
                        $em->getRepository('PruebaBundle:AcuerdosPreAreaIpd')->updatePreAreaIpd($id, $areasIpdInicio[$i], $areaIpd[$i]);
                    }else{
                        $em->getRepository('PruebaBundle:AcuerdosPreAreaIpd')->insertPreAreaIpd($id,$areaIpd[$i]);
                    }    
                }
            }

            else if( count($areaIpd) < count($areasIpdInicio)  && count($areaIpd)> -1 ){

                for ($i=0; $i < count($areasIpdInicio) ; $i++) { 

                    $em = $this->getDoctrine()->getManager();
                    if($i < count($areaIpd)){
                        $em->getRepository('PruebaBundle:AcuerdosPreAreaIpd')->updatePreAreaIpd($id, $areasIpdInicio[$i], $areaIpd[$i]);
                    }else{
                        $em->getRepository('PruebaBundle:AcuerdosPreAreaIpd')->removePreAreaIpd($id, $areasIpdInicio[$i]);
                    }    
                }
            }

        }

        $em = $this->getDoctrine()->getManager();
        $acuerdosPre = $em->getRepository(AcuerdosPre::class)->find($id);
        $areaIpdTotal = $em->getRepository(AreaIpd::class)->findAll();
        $acuerdosPreTotal = $em->getRepository(AcuerdosPre::class)->findAll();
        $acuerdosPreAreaIpd = $em->getRepository(AcuerdosPreAreaIpd::class)->findAll();
        $countAcuerdosPreAreaIpd = $em->getRepository('PruebaBundle:AcuerdosPreAreaIpd')->getCantidadPreAreaIpd($id);
        $latestObservacion = $acuerdosPre->getObservacionPre()[count($acuerdosPre->getObservacionPre())-1];
        $em = $this->getDoctrine()->getManager();
        $acuerdosPre = $em->getRepository(AcuerdosPre::class)->find($id);

        return $this->render('PruebaBundle:AcuerdosPre:update.html.twig',array("acuerdosPre" => $acuerdosPre , "observaciones" => $acuerdosPre->getObservacionPre(), "cantidadObservaciones" => count($acuerdosPre->getObservacionPre()) , 'id' => $id, "latestObservacion" => $latestObservacion->getDescripcion(), "acuerdosPreAreaIpd" => $acuerdosPreAreaIpd, "acuerdosPreTotal" => $acuerdosPreTotal, "areaIpdTotal" => $areaIpdTotal, "totalPreAreaIpd" =>$countAcuerdosPreAreaIpd[0]['total'] ));
    }

	public function acuerdosPreNuevoAction(Request $request)
    {
    
		if($request->isXmlHttpRequest()){

			$comite = $request->request->get('comite'); 
			$fecha = $request->request->get('fecha');
			$acuerdos = $request->request->get('acuerdos');
			$nroAcuerdo = $request->request->get('nroAcuerdo');
			$areaIpd = $request->request->get('areaIpd');
			$estado = $request->request->get('estado');
            $baja = $request->request->get('baja'); 
			$observaciones = $request->request->get('observaciones');
			$plazoEntrega = $request->request->get('plazoEntrega');


			$hoy = date("Y-m-d");
			
			$acuerdosPre = new AcuerdosPre();

			$acuerdosPre->setComite($comite);
			$acuerdosPre->setFecha($fecha);
			$acuerdosPre->setAcuerdos($acuerdos);
			$acuerdosPre->setNroAcuerdo($nroAcuerdo);
            $acuerdosPre->setBaja($baja);
			$acuerdosPre->setEstado($estado);
			$acuerdosPre->setPlazoEntrega($plazoEntrega);

			$em = $this->getDoctrine()->getManager();
        	$em->persist($acuerdosPre);
        	$em->flush();


        	$id_acuerdosPre=$acuerdosPre->getId();

        	$observacionesPre = new ObservacionesPre();

        	$observacionesPre->setDescripcion($observaciones);
        	$observacionesPre->setFecha($hoy);
            $acuerdosPreN =  $this->getDoctrine()->getRepository(AcuerdosPre::class)->find($id_acuerdosPre);;
        	$observacionesPre->setAcuerdoPre($acuerdosPreN);

			$em = $this->getDoctrine()->getManager();
        	$em->persist($observacionesPre);
        	$em->flush();

            for ($i=0; $i <count($areaIpd) ; $i++) { 

                $acuerdosPreAreaIpd = new AcuerdosPreAreaIpd();
                $em = $this->getDoctrine()->getManager();

                $areaIpdN =  $this->getDoctrine()->getRepository(AreaIpd::class)->find($areaIpd[$i]);
                $acuerdosPreAreaIpd->setAreaIpd($areaIpdN);

                $acuerdosPreAreaIpd->setAcuerdoPre($acuerdosPreN);
                $em->persist($acuerdosPreAreaIpd);
                $em->flush();
            }

			return new JsonResponse("1");
		}    	

        return $this->render('PruebaBundle:AcuerdosPre:nuevo.html.twig');
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

    public function acuerdosPreRemoveAction(Request $request,$id){

        if($request->isXmlHttpRequest()){
            
            $baja = $request->request->get('baja');
            $id = $request->request->get('id');

            $em = $this->getDoctrine()->getManager(); 
            $acuerdosSG = $em->getRepository(AcuerdosPre::class)->find($id);

            $acuerdosSG->setBaja($baja);
            $em->flush();

            $jsonContent="1";
            return new JsonResponse($jsonContent);
        }


        return $this->render('PruebaBundle:AcuerdosPre:remove.html.twig', array("id" => $id));
    }

    
        public function sendemailAction(Request $request){

            if($request->isXmlHttpRequest()){

                $nombre = $request->request->get('nombre');
                $email= $request->request->get('email');
                $mensaje=$request->request->get('mensaje');
                            
                $subject = 'Notificacion Secretaria General';
                $message = 'Usted tiene un acuerdo pendiente de implementación, informar a la Secretaría General su cumplimiento'."\r\n"."\r\n".'COMENTARIO: '."\r\n"."\r\n". $mensaje ;
                $headers = 'From: pilar@ipd.gob.pe' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                mail($email, $subject, $message, $headers);
                return new JsonResponse("enviado");
        }
    }

    
    

    
}
