<?php

namespace PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AcuerdosSGAreaIpd
 *
 * @ORM\Table(name="acuerdos_s_g_area_ipd")
 * @ORM\Entity(repositoryClass="PruebaBundle\Repository\AcuerdosSGAreaIpdRepository")
 */
class AcuerdosSGAreaIpd
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="AreaIpd", inversedBy="acuerdoSGAreaIpd")
     * @ORM\JoinColumn(name="areaIpd_id", referencedColumnName="id")
     */
    private $areaIpd;


    /**
     * @ORM\ManyToOne(targetEntity="AcuerdosSG", inversedBy="acuerdoSGAreaIpd")
     * @ORM\JoinColumn(name="acuerdoSG_id", referencedColumnName="id")
     */
    private $acuerdoSG;


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
     * @return AcuerdosSGAreaIpd
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
     * Set acuerdoSG
     *
     * @param \PruebaBundle\Entity\AcuerdosSG $acuerdoSG
     *
     * @return AcuerdosSGAreaIpd
     */
    public function setAcuerdoSG(\PruebaBundle\Entity\AcuerdosSG $acuerdoSG = null)
    {
        $this->acuerdoSG = $acuerdoSG;

        return $this;
    }

    /**
     * Get acuerdoSG
     *
     * @return \PruebaBundle\Entity\AcuerdosSG
     */
    public function getAcuerdoSG()
    {
        return $this->acuerdoSG;
    }
}
