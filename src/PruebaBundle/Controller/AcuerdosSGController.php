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
use PruebaBundle\Entity\AcuerdosSGAreaIpd;
use PruebaBundle\Entity\ObservacionesSG;

class AcuerdosSGController extends Controller
{
	public function acuerdosSGAction(Request $request)
    {

        $enProceso = 'En Proceso';
        $implementado = 'Implementado';
        $cancelado = 'Cancelado';
        $noAplica = 'No Aplica';

        $em = $this->getDoctrine()->getManager();

        $mdlCantidadEnProceso = $em->getRepository('PruebaBundle:AcuerdosSG')->getCantidadEstadoSG($enProceso);
        $mdlCantidadImplementado = $em->getRepository('PruebaBundle:AcuerdosSG')->getCantidadEstadoSG($implementado);
        $mdlCantidadCancelado = $em->getRepository('PruebaBundle:AcuerdosSG')->getCantidadEstadoSG($cancelado);
        $mdlCantidadnoAplica = $em->getRepository('PruebaBundle:AcuerdosSG')->getCantidadEstadoSG($noAplica);
        $mdlCantidadSG = $em->getRepository('PruebaBundle:AcuerdosSG')->getCantidadSG();

        $acuerdosSGAreaIpd =  $this->getDoctrine()->getRepository(AcuerdosSG::class)->findAll();
        $acuerdosSGAreaIpd =  $this->getDoctrine()->getRepository(AreaIpd::class)->findAll();
        $acuerdosSGAreaIpd =  $this->getDoctrine()->getRepository(AcuerdosSGAreaIpd::class)->findAll();

    	return $this->render('PruebaBundle:AcuerdosSG:acuerdosSG.html.twig', array( 'cantidadEnProceso' => $mdlCantidadEnProceso , 'cantidadImplementado' => $mdlCantidadImplementado, 'cantidadCancelado' => $mdlCantidadCancelado, 'cantidadNoAplica' => $mdlCantidadnoAplica, 'cantidadSG' => $mdlCantidadSG, "acuerdosSGAreaIpd" => $acuerdosSGAreaIpd ) );
    }

	public function acuerdosSGNuevoAction(Request $request)
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
            $baja = $request->request->get('baja');
			$hoy = date("Y-m-d");
			
			$acuerdosSG = new AcuerdosSG();

			$acuerdosSG->setSesion($sesion);
			$acuerdosSG->setFecha($fecha);
			$acuerdosSG->setAgenda($agenda);
			$acuerdosSG->setAcuerdos($acuerdos);        	
			$acuerdosSG->setEstado($estado);
            $acuerdosSG->setBaja($baja);
			$acuerdosSG->setPlazoEntrega($plazoEntrega);

			$em = $this->getDoctrine()->getManager();
        	$em->persist($acuerdosSG);
        	$em->flush();

        	$id_acuerdosSG = $acuerdosSG->getId();

        	$observacionesSG = new ObservacionesSG();
        	$observacionesSG->setDescripcion($observaciones);
        	$observacionesSG->setFecha($hoy);
            $acuerdosSGN =  $this->getDoctrine()->getRepository(AcuerdosSG::class)->find($id_acuerdosSG);
        	$observacionesSG->setAcuerdoSG($acuerdosSGN);
			$em = $this->getDoctrine()->getManager();
        	$em->persist($observacionesSG);
        	$em->flush();

            for ($i=0; $i <count($areaIpd) ; $i++) { 

                $acuerdosSgAreaIpd = new AcuerdosSGAreaIpd();
                $em = $this->getDoctrine()->getManager();

                $areaIpdN =  $this->getDoctrine()->getRepository(AreaIpd::class)->find($areaIpd[$i]);
                $acuerdosSgAreaIpd->setAreaIpd($areaIpdN);

                $acuerdosSgAreaIpd->setAcuerdoSG($acuerdosSGN);
                $em->persist($acuerdosSgAreaIpd);
                $em->flush();

            }

            return new JsonResponse("1");                
                
		}    

        $em = $this->getDoctrine()->getManager();

        $areaIpdTotal = $em->getRepository(AreaIpd::class)->findAll();
        $acuerdosSGTotal = $em->getRepository(AcuerdosSG::class)->findAll();
        $acuerdosSGAreaIpd = $em->getRepository(AcuerdosSGAreaIpd::class)->findAll();
        
        return $this->render('PruebaBundle:AcuerdosSG:nuevo.html.twig',array("acuerdosSGAreaIpd" => $acuerdosSGAreaIpd, "acuerdosSGTotal", "areaIpdTotal" => $areaIpdTotal) );
    }




	public function acuerdosSGGetAction(Request $request){

		$em =  $this->getDoctrine()->getRepository(AcuerdosSG::class);
    	$acuerdosSGAll = $em->findAll();

        $encoders = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($acuerdosSGAll, 'json');

		return new JsonResponse($jsonContent);

	}

    public function acuerdosSGUpdateAction(Request $request, $id){

        if($request->isXmlHttpRequest()){

            $sesion = $request->request->get('sesion'); 
            $fecha = $request->request->get('fecha');
            $agenda = $request->request->get('agenda');
            $acuerdos = $request->request->get('acuerdos');
            $areaIpd = $request->request->get('areaIpd');
            $areasIpdInicio = $request->request->get('areasIpdInicio'); 
            $estado = $request->request->get('estado'); 
            $observaciones = $request->request->get('observaciones');
            $plazoEntrega = $request->request->get('plazoEntrega');
            
            $em_as = $this->getDoctrine()->getManager(); 
            $acuerdosSG = $em_as->getRepository(AcuerdosSG::class)->find($id);

            $acuerdosSG->setSesion($sesion);
            $acuerdosSG->setFecha($fecha);
            $acuerdosSG->setAgenda($agenda);
            $acuerdosSG->setAcuerdos($acuerdos);
            $acuerdosSG->setEstado($estado);
            $acuerdosSG->setPlazoEntrega($plazoEntrega);
            
            $em_as->flush();

            $id_acuerdosSG=$acuerdosSG->getId();
            $latestObservacion = $acuerdosSG->getObservacionSG()[count($acuerdosSG->getObservacionSG())-1];
            //var_dump($latestObservacion);
            //SE GUARDA LA NUEVA OBSERVACION SI ES DIFERENTE A LA ULTIMA INGRESADA
            if($observaciones != $latestObservacion->getDescripcion()){

                $observacionesSG = new ObservacionesSG();
                $hoy = date("Y-m-d");
                $observacionesSG->setDescripcion($observaciones);
                $observacionesSG->setFecha($hoy);

                //SE REALIZA LA BUSQUEDA DEL ULTIMO ACUERDO SG INGRESADO
                $em =  $this->getDoctrine()->getRepository(AcuerdosSG::class);
                $acuerdosSGN = $em->find($id_acuerdosSG);

                //SE ASIGNA EL ULTIMO ACUERDO INGRESADO POR AJAX AL OBJETO OBSERVACIONESSG
                $observacionesSG->setAcuerdoSG($acuerdosSGN);

                //SE GUARDA EN LA BASE DE DATOS
                $em = $this->getDoctrine()->getManager();
                $em->persist($observacionesSG);
                $em->flush();
            }

            $em = $this->getDoctrine()->getManager();
            $countAcuerdosSGAreaIpd = $em->getRepository('PruebaBundle:AcuerdosSGAreaIpd')->getCantidadSGAreaIpd($id);

            if(count($areaIpd) >= count($areasIpdInicio)){
                for ($i=0; $i < count($areaIpd) ; $i++) { 

                    $em = $this->getDoctrine()->getManager();
                    if($i < count($areasIpdInicio)){
                        $em->getRepository('PruebaBundle:AcuerdosSGAreaIpd')->updateSGAreaIpd($id, $areasIpdInicio[$i], $areaIpd[$i]);
                    }else{
                        $em->getRepository('PruebaBundle:AcuerdosSGAreaIpd')->insertSGAreaIpd($id,$areaIpd[$i]);
                    }    
                }
            }
            
            else if( count($areaIpd) < count($areasIpdInicio)  && count($areaIpd)> -1 ){

                for ($i=0; $i < count($areasIpdInicio) ; $i++) { 

                    $em = $this->getDoctrine()->getManager();
                    if($i < count($areaIpd)){
                        $em->getRepository('PruebaBundle:AcuerdosSGAreaIpd')->updateSGAreaIpd($id, $areasIpdInicio[$i], $areaIpd[$i]);
                    }else{
                        $em->getRepository('PruebaBundle:AcuerdosSGAreaIpd')->removeSGAreaIpd($id, $areasIpdInicio[$i]);
                    }    
                }
            }     


            $jsonContent="Se Edito Correctamente";
            return new JsonResponse($jsonContent);
        }

        $em = $this->getDoctrine()->getManager();
        $acuerdosSG = $em->getRepository(AcuerdosSG::class)->find($id);

        $areaIpdTotal = $em->getRepository(AreaIpd::class)->findAll();
        $acuerdosSGTotal = $em->getRepository(AcuerdosSG::class)->findAll();
        $acuerdosSGAreaIpd = $em->getRepository(AcuerdosSGAreaIpd::class)->findAll();
        

        $countAcuerdosSGAreaIpd = $em->getRepository('PruebaBundle:AcuerdosSGAreaIpd')->getCantidadSGAreaIpd($id);

        $latestObservacion = $acuerdosSG->getObservacionSG()[count($acuerdosSG->getObservacionSG())-1];

        return $this->render('PruebaBundle:AcuerdosSG:update.html.twig',array("acuerdosSG" => $acuerdosSG , "observaciones" => $acuerdosSG->getObservacionSG(), "cantidadObservaciones" => count($acuerdosSG->getObservacionSG()) , 'id' => $id , "latestObservacion" => $latestObservacion->getDescripcion(), "acuerdosSGAreaIpd" => $acuerdosSGAreaIpd, "acuerdosSGTotal" => $acuerdosSGTotal , "areaIpdTotal" => $areaIpdTotal, "totalSGAreaIpd" =>$countAcuerdosSGAreaIpd[0]['total'] ));
    }

    public function acuerdosSGRemoveAction(Request $request,$id){

        if($request->isXmlHttpRequest()){
            
            $baja = $request->request->get('baja');
            $id = $request->request->get('id');

            $em = $this->getDoctrine()->getManager(); 
            $acuerdosSG = $em->getRepository(AcuerdosSG::class)->find($id);

            $acuerdosSG->setBaja($baja);
            $em->flush();

            $jsonContent="1";
            return new JsonResponse($jsonContent);
        }


        return $this->render('PruebaBundle:AcuerdosSG:remove.html.twig', array("id" => $id));
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
