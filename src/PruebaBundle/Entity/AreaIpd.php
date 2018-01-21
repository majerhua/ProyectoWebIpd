<?php

namespace PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AreaIpd
 *
 * @ORM\Table(name="area_ipd")
 * @ORM\Entity(repositoryClass="PruebaBundle\Repository\AreaIpdRepository")
 */
class AreaIpd
{


     /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="areaIpd")
     */
    private $usuarios;

    /**
     * @ORM\OneToMany(targetEntity="AcuerdosSGAreaIpd", mappedBy="areaIpd")
     */
    private $acuerdoSGAreaIpd;

    /**
     * @ORM\OneToMany(targetEntity="AcuerdosPreAreaIpd", mappedBy="areaIpd")
     */
    private $acuerdoPreAreaIpd;

     /**
     * @ORM\OneToMany(targetEntity="Indicador", mappedBy="areaIpd")
     */
    private $indicadores;


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
     * @return AreaIpd
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
     * Constructor
     */
    public function __construct()
    {
        $this->indicadores = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add indicadore
     *
     * @param \PruebaBundle\Entity\Indicador $indicadore
     *
     * @return AreaIpd
     */
    public function addIndicadore(\PruebaBundle\Entity\Indicador $indicadore)
    {
        $this->indicadores[] = $indicadore;

        return $this;
    }

    /**
     * Remove indicadore
     *
     * @param \PruebaBundle\Entity\Indicador $indicadore
     */
    public function removeIndicadore(\PruebaBundle\Entity\Indicador $indicadore)
    {
        $this->indicadores->removeElement($indicadore);
    }

    /**
     * Get indicadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIndicadores()
    {
        return $this->indicadores;
    }

    public function __toString(){
        return $this->nombre;
    }


    /**
     * Add usuario
     *
     * @param \PruebaBundle\Entity\Usuario $usuario
     *
     * @return AreaIpd
     */
    public function addUsuario(\PruebaBundle\Entity\Usuario $usuario)
    {
        $this->usuarios[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \PruebaBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\PruebaBundle\Entity\Usuario $usuario)
    {
        $this->usuarios->removeElement($usuario);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add acuerdoSGAreaIpd
     *
     * @param \PruebaBundle\Entity\AcuerdosSGAreaIpd $acuerdoSGAreaIpd
     *
     * @return AreaIpd
     */
    public function addAcuerdoSGAreaIpd(\PruebaBundle\Entity\AcuerdosSGAreaIpd $acuerdoSGAreaIpd)
    {
        $this->acuerdoSGAreaIpd[] = $acuerdoSGAreaIpd;

        return $this;
    }

    /**
     * Remove acuerdoSGAreaIpd
     *
     * @param \PruebaBundle\Entity\AcuerdosSGAreaIpd $acuerdoSGAreaIpd
     */
    public function removeAcuerdoSGAreaIpd(\PruebaBundle\Entity\AcuerdosSGAreaIpd $acuerdoSGAreaIpd)
    {
        $this->acuerdoSGAreaIpd->removeElement($acuerdoSGAreaIpd);
    }

    /**
     * Get acuerdoSGAreaIpd
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcuerdoSGAreaIpd()
    {
        return $this->acuerdoSGAreaIpd;
    }

    /**
     * Add acuerdoPreAreaIpd
     *
     * @param \PruebaBundle\Entity\AcuerdosPreAreaIpd $acuerdoPreAreaIpd
     *
     * @return AreaIpd
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

    public function getAcuerdoPre(){
        
    }
}
