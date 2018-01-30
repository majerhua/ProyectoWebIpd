<?php

namespace PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicador
 *
 * @ORM\Table(name="indicador")
 * @ORM\Entity(repositoryClass="PruebaBundle\Repository\IndicadorRepository")
 */
class Indicador
{

    /**
     * @ORM\OneToMany(targetEntity="DetalleIndicador", mappedBy="indicador")
     */
    private $detallesIndicador;

    /**
     * @ORM\OneToMany(targetEntity="TotalIndicadores", mappedBy="indicador")
     */
    private $totalesindicadores;


    /**
     * @ORM\OneToMany(targetEntity="Leyenda", mappedBy="indicador")
     */
    private $leyendas;

    /**
     * @ORM\ManyToOne(targetEntity="AreaIpd", inversedBy="indicadores")
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Indicador
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set areaIpd
     *
     * @param \PruebaBundle\Entity\AreaIpd $areaIpd
     *
     * @return Indicador
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
     * Constructor
     */
    public function __construct()
    {
        $this->leyendas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->totalesindicadores = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add leyenda
     *
     * @param \PruebaBundle\Entity\Leyenda $leyenda
     *
     * @return Indicador
     */
    public function addLeyenda(\PruebaBundle\Entity\Leyenda $leyenda)
    {
        $this->leyendas[] = $leyenda;

        return $this;
    }

    /**
     * Remove leyenda
     *
     * @param \PruebaBundle\Entity\Leyenda $leyenda
     */
    public function removeLeyenda(\PruebaBundle\Entity\Leyenda $leyenda)
    {
        $this->leyendas->removeElement($leyenda);
    }

    /**
     * Get leyendas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLeyendas()
    {
        return $this->leyendas;
    }




    /**
     * Add detallesIndicador
     *
     * @param \PruebaBundle\Entity\DetalleIndicador $detallesIndicador
     *
     * @return Indicador
     */
    public function addDetallesIndicador(\PruebaBundle\Entity\DetalleIndicador $detallesIndicador)
    {
        $this->detallesIndicador[] = $detallesIndicador;

        return $this;
    }

    /**
     * Remove detallesIndicador
     *
     * @param \PruebaBundle\Entity\DetalleIndicador $detallesIndicador
     */
    public function removeDetallesIndicador(\PruebaBundle\Entity\DetalleIndicador $detallesIndicador)
    {
        $this->detallesIndicador->removeElement($detallesIndicador);
    }

    /**
     * Get detallesIndicador
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetallesIndicador()
    {
        return $this->detallesIndicador;
    }



    /**
     * Add totalesindicadore
     *
     * @param \PruebaBundle\Entity\TotalIndicadores $totalesindicadore
     *
     * @return Indicador
     */
    public function addTotalesindicadore(\PruebaBundle\Entity\TotalIndicadores $totalesindicadore)
    {
        $this->totalesindicadores[] = $totalesindicadore;

        return $this;
    }

    /**
     * Remove totalesindicadore
     *
     * @param \PruebaBundle\Entity\TotalIndicadores $totalesindicadore
     */
    public function removeTotalesindicadore(\PruebaBundle\Entity\TotalIndicadores $totalesindicadore)
    {
        $this->totalesindicadores->removeElement($totalesindicadore);
    }

    /**
     * Get totalesindicadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTotalesindicadores()
    {
        return $this->totalesindicadores;
    }

    public function __toString(){
        return $this->nombre;
    }
}
