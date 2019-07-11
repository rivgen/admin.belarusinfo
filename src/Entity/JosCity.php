<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="jos_city")
 * @ORM\Entity()
 */
class JosCity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="City_ID", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(name="City_Name", type="text", nullable=false)
     */
    private $cityName;

    /**
     * @ORM\Column(name="Region_ID", type="integer", nullable=false)
     */
    private $regionId;

    /**
     * @ORM\Column(name="c_title", type="text", nullable=false)
     */
    private $cTitle;

    /**
     * @ORM\Column(name="city", type="text", nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(name="dependencies", type="integer", nullable=false)
     */
    private $dependencies;

    /**
     * @ORM\OneToMany(targetEntity="JosAdminClients", mappedBy="city")
     */
    private $clients;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @param mixed $cityName
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    }

    /**
     * @return mixed
     */
    public function getRegionId()
    {
        return $this->regionId;
    }

    /**
     * @param mixed $regionId
     */
    public function setRegionId($regionId)
    {
        $this->regionId = $regionId;
    }

    /**
     * @return mixed
     */
    public function getCTitle()
    {
        return $this->cTitle;
    }

    /**
     * @param mixed $cTitle
     */
    public function setCTitle($cTitle)
    {
        $this->cTitle = $cTitle;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * @param mixed $dependencies
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;
    }

    /**
     * @return mixed
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * @param mixed $clients
     */
    public function setClients($clients)
    {
        $this->clients = $clients;
    }

}
