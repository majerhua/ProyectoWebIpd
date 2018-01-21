<?php

namespace PruebaBundle\Repository;

/**
 * AcuerdosSGAreaIpdRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AcuerdosSGAreaIpdRepository extends \Doctrine\ORM\EntityRepository
{

	public function getCantidadSG(){

        $query = "select count(estado) as cantidadEstado from acuerdos_s_g where baja='1';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $countSG = $stmt->fetchAll();

        return $countSG;

	}


	public function getCantidadSGAreaIpd($acuerdoSGId){

        $query = "select COUNT(*) as total from acuerdos_s_g_area_ipd where acuerdoSG_id='$acuerdoSGId';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $countSGAreaIpd = $stmt->fetchAll();

        return $countSGAreaIpd;

	}

	public function updateSGAreaIpd($acuerdoSGId, $areaIpdId, $newAreaIpdId){

        $query = "update acuerdos_s_g_area_ipd set areaIpd_id = $newAreaIpdId where areaIpd_id = '$areaIpdId' and acuerdoSG_id ='$acuerdoSGId';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();

	}

	public function insertSGAreaIpd($acuerdoSGId, $areaIpdId){

        $query = "insert into acuerdos_s_g_area_ipd(areaIpd_id,acuerdoSG_id) values('$areaIpdId','$acuerdoSGId');";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();

	}

	public function removeSGAreaIpd($acuerdoSGId, $areaIpdId){

        $query = "delete from acuerdos_s_g_area_ipd  where areaIpd_id='$areaIpdId' and acuerdoSG_id='$acuerdoSGId';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();

	}
}
