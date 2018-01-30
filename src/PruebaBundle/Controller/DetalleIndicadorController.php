<?php

namespace PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

use PruebaBundle\Form\DetalleIndicadorType;
use Symfony\Component\HttpFoundation\Request;

use PruebaBundle\Entity\Leyenda;
use PruebaBundle\Entity\DetalleIndicador;
use PruebaBundle\Entity\Indicador;
use PruebaBundle\Entity\TotalIndicadores;

use PruebaBundle\Form\LeyendaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DetalleIndicadorController extends Controller
{

     public function pruebaAction(Request $request){
        
        $html = $this->renderView('PruebaBundle:DetalleIndicador:prueba.html.twig');
     
        $pdf = $this->container->get("white_october.tcpdf")->create();
        $pdf->SetAuthor('IPD');
        $pdf->setPrintHeader(false);
        $pdf->SetTitle('Declaracion Jurada');
        $pdf->SetSubject('Mecenazgo Deportivo');
        $pdf->SetKeywords('TCPDF, PDF, Mecenazgo Deportivo, IPD, Sistemas IPD, Deportistas');       
        $pdf->AddPage();
        $pdf->setCellPaddings(0, 0, 0, 0);                
        $pdf->writeHTMLCell(
                    $w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true
            );         
        $pdf->writeHTML($html);
        $pdf->Output("compromisoIPD.pdf", 'I');        
    }

	public function nuevoDetalleIndicadorAction(Request $request, $tipo){

        if($request->isXmlHttpRequest()){

            $mensaje="";
            $indicador = $request->request->get('indicador');
            $nombre = $request->request->get('nombre');
            $enero = $request->request->get('enero');
            $febrero = $request->request->get('febrero');
            $marzo = $request->request->get('marzo');
            $abril = $request->request->get('abril');
            $mayo = $request->request->get('mayo');
            $junio = $request->request->get('junio');
            $julio = $request->request->get('julio');
            $agosto = $request->request->get('agosto');
            $septiembre = $request->request->get('septiembre');
            $octubre = $request->request->get('octubre');
            $noviembre = $request->request->get('noviembre');
            $diciembre = $request->request->get('diciembre');
            $tipo = $request->request->get('tipo');
            try {
                $em = $this->getDoctrine()->getManager();
                $em->getRepository('PruebaBundle:DetalleIndicador')->insertarDetalleIndicador($indicador,$nombre,$enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre, $tipo);
                $mensaje="no hay error";
            }catch(Exception $e) {
                $mensaje = 'Ha habido una excepción: '.$e->getMessage() ;

            }

            return new JsonResponse($mensaje);

        }

		return $this->render('PruebaBundle:DetalleIndicador:nuevo.html.twig', array( "tipo" => $tipo ));
	}

	public function verDetalleIndicadorAction(Request $request){

		$em =  $this->getDoctrine()->getRepository(DetalleIndicador::class);;
		$detallesIndicador = $em->findAll();

        $em =  $this->getDoctrine()->getRepository(TotalIndicadores::class);;
        $totalIndicadores = $em->findAll();

        $em =  $this->getDoctrine()->getRepository(Leyenda::class);;
        $leyendas = $em->findAll();

        $em =  $this->getDoctrine()->getRepository(Indicador::class);;
        $indicadores = $em->findAll();


        foreach ($indicadores as $indicador) {
            
            $c=0;

            $totalArray = array();
            foreach ($detallesIndicador as $detalleIndicador) {
                
                if($indicador->getId() == $detalleIndicador->getIndicador()->getId()){
                    $c++;
                    //array_push($totalArray,$indicador->getNombre());
                    array_push($totalArray,$detalleIndicador->getEnero());
                    array_push($totalArray,$detalleIndicador->getFebrero());
                    array_push($totalArray,$detalleIndicador->getMarzo());
                    array_push($totalArray,$detalleIndicador->getAbril());
                    array_push($totalArray,$detalleIndicador->getMayo());
                    array_push($totalArray,$detalleIndicador->getJunio());
                    array_push($totalArray,$detalleIndicador->getJulio());
                    array_push($totalArray,$detalleIndicador->getAgosto());
                    array_push($totalArray,$detalleIndicador->getSeptiembre());
                    array_push($totalArray,$detalleIndicador->getOctubre());
                    array_push($totalArray,$detalleIndicador->getNoviembre());
                    array_push($totalArray,$detalleIndicador->getDiciembre());
                }

            }

            $totalIndicadorArray = array();
            if($c==2){

                for ($i=0; $i < 12 ; $i++) { 
                    
                    if($totalArray[$i] == 0 || $totalArray[$i+12] == 0 ){
                        array_push($totalIndicadorArray,0);   
                    }else if($totalArray[$i] != 0){
                        $totalInd = round( ($totalArray[$i+12]/$totalArray[$i])*100, 0 );
                        array_push($totalIndicadorArray,$totalInd);
                    }
                }

            }


            else if($c==1){

                for ($i=0; $i < 12 ; $i++) { 
                    
                    if($totalArray[$i]< 0){
                        array_push($totalIndicadorArray,0);   
                    }else if($totalArray[$i] > -1){
                        array_push($totalIndicadorArray,$totalArray[$i]);
                    }
                }

            }

            $em = $this->getDoctrine()->getManager();
            $total_busqueda = $this->getDoctrine()->getRepository(TotalIndicadores::class)->findAll();           

                $flag=false;               
                foreach ($total_busqueda  as $valueTotal) {
                        
                    if( $valueTotal->getIndicador()->getNombre() == $indicador->getNombre() ){
                        $mensaje= " si existe igualdad ";
                        $flag=true;
                        break;
                    } 
                }

                if($flag){
                    $em = $this->getDoctrine()->getManager();
                    $em->getRepository('PruebaBundle:TotalIndicadores')->updateTotalIndicador($indicador->getId(),$totalIndicadorArray[0],$totalIndicadorArray[1],$totalIndicadorArray[2],$totalIndicadorArray[3],$totalIndicadorArray[4],$totalIndicadorArray[5],$totalIndicadorArray[6],$totalIndicadorArray[7],$totalIndicadorArray[8],$totalIndicadorArray[9],$totalIndicadorArray[10],$totalIndicadorArray[11]);
                }

                if(!$flag){
                    $mensaje = "No existe igualdad";

                    if(!empty($totalIndicadorArray)){
                            $total_indicadores = new TotalIndicadores();
                            $total_indicadores->setEnero($totalIndicadorArray[0]);
                            $total_indicadores->setFebrero($totalIndicadorArray[1]);
                            $total_indicadores->setMarzo($totalIndicadorArray[2]);
                            $total_indicadores->setAbril($totalIndicadorArray[3]);
                            $total_indicadores->setMayo($totalIndicadorArray[4]);
                            $total_indicadores->setJunio($totalIndicadorArray[5]);
                            $total_indicadores->setJulio($totalIndicadorArray[6]);
                            $total_indicadores->setAgosto($totalIndicadorArray[7]);
                            $total_indicadores->setSeptiembre($totalIndicadorArray[8]);
                            $total_indicadores->setOctubre($totalIndicadorArray[9]);
                            $total_indicadores->setNoviembre($totalIndicadorArray[10]);
                            $total_indicadores->setDiciembre($totalIndicadorArray[11]);
                            $indicador = $this->getDoctrine()->getRepository(Indicador::class)->find($indicador->getId()); 
                            $total_indicadores->setIndicador($indicador);
                            $k= $total_indicadores->getIndicador()->getNombre();

                            $em->persist($total_indicadores);
                            $em->flush();                        
                    }

                }

            }

        $em =  $this->getDoctrine()->getRepository(TotalIndicadores::class);;
        $totalIndicadores = $em->findAll();

		return $this->render('PruebaBundle:DetalleIndicador:ver.html.twig',array("detallesIndicador" => $detallesIndicador, "leyendas" => $leyendas , "totalIndicadores" => $totalIndicadores , "indicadores" => $indicadores, "c"=>$totalIndicadorArray) );
	}

	public function updateDetalleindicadorAction(Request $request, $id) {

		$post = $this->getDoctrine()->getRepository(DetalleIndicador::class)->find($id);

		$atrributes = array('class' => 'form-control' , 'style' => 'margin-bottom:1px');
        $atrributeButton = array('class' => 'btn btn-success', 'style' => 'margin-top:6px');

		$form  = $this->createFormBuilder($post)

		->add('nombre',TextType::class,array('attr'  => $atrributes))
        ->add('enero',IntegerType::class,array('attr'  => $atrributes))
        ->add('febrero',IntegerType::class,array('attr'  => $atrributes))
        ->add('marzo',IntegerType::class,array('attr'  => $atrributes))
        ->add('abril',IntegerType::class,array('attr'  => $atrributes))
        ->add('mayo',IntegerType::class,array('attr'  => $atrributes))
        ->add('junio',IntegerType::class,array('attr'  => $atrributes))
        ->add('julio',IntegerType::class,array('attr'  => $atrributes))
        ->add('agosto',IntegerType::class,array('attr'  => $atrributes))
        ->add('septiembre',IntegerType::class,array('attr'  => $atrributes))
        ->add('octubre',IntegerType::class,array('attr'  => $atrributes))
        ->add('noviembre',IntegerType::class,array('attr'  => $atrributes))
        ->add('diciembre',IntegerType::class,array('attr'  => $atrributes))
        ->add('indicador')
        ->add('Editar',SubmitType::class,array('attr' =>  $atrributeButton))

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
        
        if($request->isXmlHttpRequest())
        {

            $post = $this->getDoctrine()->getRepository(DetalleIndicador::class)->findAll(); 
            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(1);
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);
            $jsonContent = $serializer->serialize($post[0], 'json');

            return new JsonResponse($jsonContent);       
        }        
    }

    //Mostrar Ficha de Control
    public function detalleIndicadorGraficaAction(Request $request, $id)
    {   
    
        $arrayFormGet = array();
        

        $titulo = $request->get('titulo');
        $organo = $request->get('organo');
        $mesReporte = $request->get('mes-reporte');
        $proceso = $request->get('proceso');
        $objetivo = $request->get('objetivo');
        $calculo = $request->get('calculo');
        $fuente = $request->get('fuente');
        $accion = $request->get('accion');
        $fecha = $request->get('fecha');
        $responsable = $request->get('responsable');
        
        array_push($arrayFormGet,$titulo);
        array_push($arrayFormGet,$organo);
        array_push($arrayFormGet,$mesReporte);
        array_push($arrayFormGet,$proceso);
        array_push($arrayFormGet,$objetivo);
        array_push($arrayFormGet,$calculo);
        array_push($arrayFormGet,$fuente);
        array_push($arrayFormGet,$accion);
        array_push($arrayFormGet,$fecha);
        array_push($arrayFormGet,$responsable);
        
        
        $snappy = $this->get('knp_snappy.pdf');
        $post = $this->getDoctrine()->getRepository(Indicador::class)->find($id);
        $html = $this->renderView('PruebaBundle:DetalleIndicador:graficos.html.twig', array("id" => $id,"leyendas" =>$post->getLeyendas()[0], "indicador" => $post, "total" => $post->getTotalesindicadores()[0], "arrayFormGet" => $arrayFormGet));
         $filename = "file";
        return new Response(
            $snappy->getOutputFromHtml($html,
                    array(
                        'encoding' => 'utf-8',
                        'title'=> 'Personal con Certificado',
                        'images' => true,
                        'enable-javascript' => true,
                        'javascript-delay' => 4000,
                        'no-stop-slow-scripts' =>false
                    )
            ),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename = "'.$filename.'.pdf" '
            )
        );
       /* 
        
        $post = $this->getDoctrine()->getRepository(Indicador::class)->find($id);
       return $this->render('PruebaBundle:DetalleIndicador:graficos.html.twig', array("id" => $id,"leyendas" =>$post->getLeyendas()[0], "indicador" => $post, "total" => $post->getTotalesindicadores()[0], "arrayFormGet" => $arrayFormGet));
       */
    }

    public function detalleIndicadorGraficaFormAction(Request $request, $id)
    {   
 
        $post = $this->getDoctrine()->getRepository(Indicador::class)->find($id);
       return $this->render('PruebaBundle:DetalleIndicador:graficaForm.html.twig', array("id" => $id,"leyendas" =>$post->getLeyendas()[0], "indicador" => $post, "total" => $post->getTotalesindicadores()[0]));
       
    }




    public function postTotalInicioAction(Request  $request){

        $jsonContent=null;        
        $mensaje="";

        if( $request->isXmlHttpRequest() ){

            $total = $request->request->get('total');
            $em = $this->getDoctrine()->getManager();
            $total_busqueda = $this->getDoctrine()->getRepository(TotalIndicadores::class)->findAll();           

            foreach ($total as $key => $value) {
                $flag=false;               
                foreach ($total_busqueda as $key => $valueTotal) {
                        
                    if( $valueTotal->getIndicador()->getNombre() == $value[0] ){
                        $mensaje= " si existe igualdad ";
                        $flag=true;
                        break;
                    }
                }

                if($flag==false){
                    $mensaje = "No existe igualdad";
                    $total_indicadores = new TotalIndicadores();
                    $total_indicadores->setEnero($value[2]);
                    $total_indicadores->setFebrero($value[3]);
                    $total_indicadores->setMarzo($value[4]);
                    $total_indicadores->setAbril($value[5]);
                    $total_indicadores->setMayo($value[6]);
                    $total_indicadores->setJunio($value[7]);
                    $total_indicadores->setJulio($value[8]);
                    $total_indicadores->setAgosto($value[9]);
                    $total_indicadores->setSeptiembre($value[10]);
                    $total_indicadores->setOctubre($value[11]);
                    $total_indicadores->setNoviembre($value[12]);
                    $total_indicadores->setDiciembre($value[13]);
                    $indicador = $this->getDoctrine()->getRepository(Indicador::class)->findOneBy(['nombre' => $value[0] ]); 
                    $total_indicadores->setIndicador($indicador);
                    $k= $total_indicadores->getIndicador()->getNombre();

                    $em->persist($total_indicadores);
                    $em->flush();
                }
 
            }             
        return new JsonResponse("listo"); 

        }
    }

    public function postTotalAction(Request $request){

        if( $request->isXmlHttpRequest() ){

            $idTotalIndicador = $request->request->get('idTotalIndicador');
            $totalIndicador = $this->getDoctrine()->getRepository(TotalIndicadores::class)->find($idTotalIndicador); 
            $encoders = array(new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(1);
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);
            $jsonContent = $serializer->serialize($totalIndicador, 'json');
            return new JsonResponse($jsonContent);
        }
           
    }
    
}
