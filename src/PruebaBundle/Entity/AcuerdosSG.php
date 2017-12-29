<?php

namespace PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AcuerdosSG
 *
 * @ORM\Table(name="acuerdos_s_g")
 * @ORM\Entity(repositoryClass="PruebaBundle\Repository\AcuerdosSGRepository")
 */
class AcuerdosSG
{


    /**
     * @ORM\OneToMany(targetEntity="ObservacionesSG", mappedBy="acuerdoSG")
     */
    private $observacionSG;

    /**
     * @ORM\ManyToOne(targetEntity="AreaIpd", inversedBy="acuerdoSG")
     * @ORM\JoinColumn(name="areaIpd_id", referencedColumnName="id")
     */
    private $areaIpd;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sesion", type="string", length=255)
     */
    private $sesion;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="string", length=255)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="agenda", type="string", length=255)
     */
    private $agenda;

    /**
     * @var string
     *
     * @ORM\Column(name="acuerdos", type="string", length=255)
     */
    private $acuerdos;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="plazoEntrega", type="string", length=255)
     */
    private $plazoEntrega;


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
     * Set sesion
     *
     * @param string $sesion
     *
     * @return AcuerdosSG
     */
    public function setSesion($sesion)
    {
        $this->sesion = $sesion;

        return $this;
    }

    /**
     * Get sesion
     *
     * @return string
     */
    public function getSesion()
    {
        return $this->sesion;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     *
     * @return AcuerdosSG
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set agenda
     *
     * @param string $agenda
     *
     * @return AcuerdosSG
     */
    public function setAgenda($agenda)
    {
        $this->agenda = $agenda;

        return $this;
    }

    /**
     * Get agenda
     *
     * @return string
     */
    public function getAgenda()
    {
        return $this->agenda;
    }

    /**
     * Set acuerdos
     *
     * @param string $acuerdos
     *
     * @return AcuerdosSG
     */
    public function setAcuerdos($acuerdos)
    {
        $this->acuerdos = $acuerdos;

        return $this;
    }

    /**
     * Get acuerdos
     *
     * @return string
     */
    public function getAcuerdos()
    {
        return $this->acuerdos;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return AcuerdosSG
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set plazoEntrega
     *
     * @param string $plazoEntrega
     *
     * @return AcuerdosSG
     */
    public function setPlazoEntrega($plazoEntrega)
    {
        $this->plazoEntrega = $plazoEntrega;

        return $this;
    }

    /**
     * Get plazoEntrega
     *
     * @return string
     */
    public function getPlazoEntrega()
    {
        return $this->plazoEntrega;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->observacionSG = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add observacionSG
     *
     * @param \PruebaBundle\Entity\ObservacionesSG $observacionSG
     *
     * @return AcuerdosSG
     */
    public function addObservacionSG(\PruebaBundle\Entity\ObservacionesSG $observacionSG)
    {
        $this->observacionSG[] = $observacionSG;

        return $this;
    }

    /**
     * Remove observacionSG
     *
     * @param \PruebaBundle\Entity\ObservacionesSG $observacionSG
     */
    public function removeObservacionSG(\PruebaBundle\Entity\ObservacionesSG $observacionSG)
    {
        $this->observacionSG->removeElement($observacionSG);
    }

    /**
     * Get observacionSG
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObservacionSG()
    {
        return $this->observacionSG;
    }

    /**
     * Set areaIpd
     *
     * @param \PruebaBundle\Entity\AreaIpd $areaIpd
     *
     * @return AcuerdosSG
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
}
