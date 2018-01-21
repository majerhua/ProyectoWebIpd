<?php

namespace PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AcuerdosPre
 *
 * @ORM\Table(name="acuerdos_pre")
 * @ORM\Entity(repositoryClass="PruebaBundle\Repository\AcuerdosPreRepository")
 */
class AcuerdosPre
{

    /**
     * @ORM\OneToMany(targetEntity="ObservacionesPre", mappedBy="acuerdoPre")
     */
    private $observacionPre;

    /**
     * @ORM\OneToMany(targetEntity="AcuerdosPreAreaIpd", mappedBy="acuerdoPre")
     */
    private $acuerdoPreAreaIpd;

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
     * @ORM\Column(name="fecha", type="string", length=255)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="acuerdos", type="string", length=255)
     */
    private $acuerdos;

    /**
     * @var string
     *
     * @ORM\Column(name="baja", type="string", length=1)
     */
    private $baja;
    
    /**
     * @var string
     *
     * @ORM\Column(name="comite", type="string", length=255)
     */
    private $comite;


    /**
     * @var string
     *
     * @ORM\Column(name="nroAcuerdo", type="string", length=255)
     */
    private $nroAcuerdo;

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
     * Set acuerdos
     *
     * @param string $acuerdos
     *
     * @return AcuerdosPre
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
     * Set nroAcuerdo
     *
     * @param string $nroAcuerdo
     *
     * @return AcuerdosPre
     */
    public function setNroAcuerdo($nroAcuerdo)
    {
        $this->nroAcuerdo = $nroAcuerdo;

        return $this;
    }

    /**
     * Get nroAcuerdo
     *
     * @return string
     */
    public function getNroAcuerdo()
    {
        return $this->nroAcuerdo;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return AcuerdosPre
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
     * @return AcuerdosPre
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
        $this->observacionPre = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add observacionPre
     *
     * @param \PruebaBundle\Entity\ObservacionesPre $observacionPre
     *
     * @return AcuerdosPre
     */
    public function addObservacionPre(\PruebaBundle\Entity\ObservacionesPre $observacionPre)
    {
        $this->observacionPre[] = $observacionPre;

        return $this;
    }

    /**
     * Remove observacionPre
     *
     * @param \PruebaBundle\Entity\ObservacionesPre $observacionPre
     */
    public function removeObservacionPre(\PruebaBundle\Entity\ObservacionesPre $observacionPre)
    {
        $this->observacionPre->removeElement($observacionPre);
    }

    /**
     * Get observacionPre
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObservacionPre()
    {
        return $this->observacionPre;
    }


    /**
     * Set comite
     *
     * @param string $comite
     *
     * @return AcuerdosPre
     */
    public function setComite($comite)
    {
        $this->comite = $comite;

        return $this;
    }

    /**
     * Get comite
     *
     * @return string
     */
    public function getComite()
    {
        return $this->comite;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     *
     * @return AcuerdosPre
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
     * Add acuerdoPreAreaIpd
     *
     * @param \PruebaBundle\Entity\AcuerdosPreAreaIpd $acuerdoPreAreaIpd
     *
     * @return AcuerdosPre
     */
    public function addAcuerdoPreAreaIpd(\PruebaBundle\Entity\AcuerdosPreAreaIpd $acuerdoPreAreaIpd)
    {
        $this->acuerdoPreAreaIpd[] = $acuerdoPreAreaIpd;

        return $this;
    }

    /**
     * Remove acuerdoPreAreaIpd
     *
     * @param \PruebaBundle\Entity\AcuerdosPreAreaIpd $acuerdoPreAreaIpd
     */
    public function removeAcuerdoPreAreaIpd(\PruebaBundle\Entity\AcuerdosPreAreaIpd $acuerdoPreAreaIpd)
    {
        $this->acuerdoPreAreaIpd->removeElement($acuerdoPreAreaIpd);
    }

    /**
     * Get acuerdoPreAreaIpd
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcuerdoPreAreaIpd()
    {
        return $this->acuerdoPreAreaIpd;
    }


    /**
     * Set baja
     *
     * @param string $baja
     *
     * @return AcuerdosPre
     */
    public function setBaja($baja)
    {
        $this->baja = $baja;

        return $this;
    }

    /**
     * Get baja
     *
     * @return string
     */
    public function getBaja()
    {
        return $this->baja;
    }
}
