<?php

namespace PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Leyenda
 *
 * @ORM\Table(name="leyenda")
 * @ORM\Entity(repositoryClass="PruebaBundle\Repository\LeyendaRepository")
 */
class Leyenda
{


    /**
     * @ORM\ManyToOne(targetEntity="Indicador", inversedBy="leyendas")
     * @ORM\JoinColumn(name="indicador_id", referencedColumnName="id")
     */
    private $indicador;


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
     * @ORM\Column(name="rojo", type="string", length=255)
     */
    private $rojo;

    /**
     * @var string
     *
     * @ORM\Column(name="amarillo", type="string", length=255)
     */
    private $amarillo;

    /**
     * @var string
     *
     * @ORM\Column(name="verde", type="string", length=255)
     */
    private $verde;


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
     * Set rojo
     *
     * @param string $rojo
     *
     * @return Leyenda
     */
    public function setRojo($rojo)
    {
        $this->rojo = $rojo;

        return $this;
    }

    /**
     * Get rojo
     *
     * @return string
     */
    public function getRojo()
    {
        return $this->rojo;
    }

    /**
     * Set amarillo
     *
     * @param string $amarillo
     *
     * @return Leyenda
     */
    public function setAmarillo($amarillo)
    {
        $this->amarillo = $amarillo;

        return $this;
    }

    /**
     * Get amarillo
     *
     * @return string
     */
    public function getAmarillo()
    {
        return $this->amarillo;
    }

    /**
     * Set verde
     *
     * @param string $verde
     *
     * @return Leyenda
     */
    public function setVerde($verde)
    {
        $this->verde = $verde;

        return $this;
    }

    /**
     * Get verde
     *
     * @return string
     */
    public function getVerde()
    {
        return $this->verde;
    }

    /**
     * Set indicador
     *
     * @param \PruebaBundle\Entity\Indicador $indicador
     *
     * @return Leyenda
     */
    public function setIndicador(\PruebaBundle\Entity\Indicador $indicador = null)
    {
        $this->indicador = $indicador;

        return $this;
    }

    /**
     * Get indicador
     *
     * @return \PruebaBundle\Entity\Indicador
     */
    public function getIndicador()
    {
        return $this->indicador;
    }

    
}
