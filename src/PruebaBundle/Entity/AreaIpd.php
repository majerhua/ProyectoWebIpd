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
     * @ORM\OneToMany(targetEntity="User", mappedBy="areaIpd")
     */
    private $users;


     /**
     * @ORM\OneToMany(targetEntity="AcuerdosPre", mappedBy="areaIpd")
     */
    private $acuerdoPre;

    /**
     * @ORM\OneToMany(targetEntity="AcuerdosSG", mappedBy="areaIpd")
     */
    private $acuerdoSG;


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
     * Add user
     *
     * @param \PruebaBundle\Entity\User $user
     *
     * @return AreaIpd
     */
    public function addUser(\PruebaBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \PruebaBundle\Entity\User $user
     */
    public function removeUser(\PruebaBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add acuerdoPre
     *
     * @param \PruebaBundle\Entity\AcuerdosPre $acuerdoPre
     *
     * @return AreaIpd
     */
    public function addAcuerdoPre(\PruebaBundle\Entity\AcuerdosPre $acuerdoPre)
    {
        $this->acuerdoPre[] = $acuerdoPre;

        return $this;
    }

    /**
     * Remove acuerdoPre
     *
     * @param \PruebaBundle\Entity\AcuerdosPre $acuerdoPre
     */
    public function removeAcuerdoPre(\PruebaBundle\Entity\AcuerdosPre $acuerdoPre)
    {
        $this->acuerdoPre->removeElement($acuerdoPre);
    }

    /**
     * Get acuerdoPre
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcuerdoPre()
    {
        return $this->acuerdoPre;
    }

    /**
     * Add acuerdoSG
     *
     * @param \PruebaBundle\Entity\AcuerdosSG $acuerdoSG
     *
     * @return AreaIpd
     */
    public function addAcuerdoSG(\PruebaBundle\Entity\AcuerdosSG $acuerdoSG)
    {
        $this->acuerdoSG[] = $acuerdoSG;

        return $this;
    }

    /**
     * Remove acuerdoSG
     *
     * @param \PruebaBundle\Entity\AcuerdosSG $acuerdoSG
     */
    public function removeAcuerdoSG(\PruebaBundle\Entity\AcuerdosSG $acuerdoSG)
    {
        $this->acuerdoSG->removeElement($acuerdoSG);
    }

    /**
     * Get acuerdoSG
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcuerdoSG()
    {
        return $this->acuerdoSG;
    }
}
