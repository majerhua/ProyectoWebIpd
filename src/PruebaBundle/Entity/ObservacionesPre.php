<?php

namespace PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObservacionesPre
 *
 * @ORM\Table(name="observaciones_pre")
 * @ORM\Entity(repositoryClass="PruebaBundle\Repository\ObservacionesPreRepository")
 */
class ObservacionesPre
{


    /**
     * @ORM\ManyToOne(targetEntity="AcuerdosPre", inversedBy="observacionPre")
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=750,nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="string", length=255)
     */
    private $fecha;


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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return ObservacionesPre
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }


    /**
     * Set acuerdoPre
     *
     * @param \PruebaBundle\Entity\AcuerdosPre $acuerdoPre
     *
     * @return ObservacionesPre
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

    /**
     * Set fecha
     *
     * @param string $fecha
     *
     * @return ObservacionesPre
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
}
