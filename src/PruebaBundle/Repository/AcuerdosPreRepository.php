<?php

namespace PruebaBundle\Repository;

/**
 * AcuerdosPreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AcuerdosPreRepository extends \Doctrine\ORM\EntityRepository
{

	public function getCantidadEstadoPre($estado){

        $query = "select count(estado) as cantidadEstado from acuerdos_pre  where estado = '$estado' and  baja='1';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $countEstado = $stmt->fetchAll();

        return $countEstado;

	}

	public function getCantidadPre(){

        $query = "select count(estado) as cantidadEstado from acuerdos_pre where baja='1';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $countSG = $stmt->fetchAll();

        return $countSG;

	}

}
