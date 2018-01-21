<?php

namespace PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AcuerdosPreAreaIpd
 *
 * @ORM\Table(name="acuerdos_pre_area_ipd")
 * @ORM\Entity(repositoryClass="PruebaBundle\Repository\AcuerdosPreAreaIpdRepository")
 */
class AcuerdosPreAreaIpd
{


    /**
     * @ORM\ManyToOne(targetEntity="AreaIpd", inversedBy="acuerdoPreAreaIpd")
     * @ORM\JoinColumn(name="areaIpd_id", referencedColumnName="id")
     */
    private $areaIpd;


    /**
     * @ORM\ManyToOne(targetEntity="AcuerdosPre", inversedBy="acuerdoPreAreaIpd")
     * @ORM\JoinColumn(name="acuerdoPre_id", referencedColumnName="id")
     */
    private $acuerdoPre;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set areaIpd
     *
     * @param \PruebaBundle\Entity\AreaIpd $areaIpd
     *
     * @return AcuerdosPreAreaIpd
     */
    public function setAreaIpd(\PruebaBundle\Entity\AreaIpd $areaIpd = null)
    {
        $this->areaIpd = $areaIpd;

        return $this;
    }

    /**
     * Get areaIpd
     *
     * @return \PruebaBundle\Entity\AreaIpd
     */
    public function getAreaIpd()
    {
        return $this->areaIpd;
    }

    /**
     * Set acuerdoPre
     *
     * @param \PruebaBundle\Entity\AcuerdosPre $acuerdoPre
     *
     * @return AcuerdosPreAreaIpd
     */
    public function setAcuerdoPre(\PruebaBundle\Entity\AcuerdosPre $acuerdoPre = null)
    {
        $this->acuerdoPre = $acuerdoPre;

        return $this;
    }

    /**
     * Get acuerdoPre
     *
     * @return \PruebaBundle\Entity\AcuerdosPre
     */
    public function getAcuerdoPre()
    {
        return $this->acuerdoPre;
    }
}
