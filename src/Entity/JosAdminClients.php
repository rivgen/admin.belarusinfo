<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="jos_clients")
 * @ORM\Entity
 */
class JosAdminClients
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(name="region", type="integer", nullable=true)
     */
    private $region;

    /**
     * @ORM\Column(name="city", type="integer", nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(name="published", type="datetime")
     */
    private $published;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;

    /**
     * @ORM\Column(name="ordering", type="integer", nullable=true)
     */
    private $ordering;

    /**
     * @ORM\Column(name="logo", type="integer", nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(name="client_index", type="integer", nullable=true)
     */
    private $clientIndex;

    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(name="site", type="string", length=255, nullable=true)
     */
    private $site;

    /**
     * @ORM\Column(name="reklama", type="text", nullable=true)
     */
    private $reklama;

    /**
     * @ORM\Column(name="promo", type="string", length=255, nullable=true)
     */
    private $promo;

    /**
     * @ORM\Column(name="rubric", type="string", length=255, nullable=true)
     */
    private $rubric;

    /**
     * @ORM\Column(name="rubric_description", type="text", nullable=true)
     */
    private $rubricDescription;

    /**
     * @ORM\Column(name="fi", type="integer", nullable=true)
     */
    private $fi;


    /**
     * @ORM\OneToOne(targetEntity="JosClientsKeywords", mappedBy="adminClients")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     *
     */
    private $clientsKeywords;

    /**
     * @ORM\OneToMany(targetEntity="Tel", mappedBy="client")
     */
    private $tels;

    /**
     * @ORM\OneToMany(targetEntity="Tel", mappedBy="client")
     */
    private $rubrics;

    /**
     * @return mixed
     */
    public function getClientsKeywords()
    {
        return $this->clientsKeywords;
    }

    /**
     * @param mixed $clientsKeywords
     */
    public function setClientsKeywords($clientsKeywords)
    {
        $this->clientsKeywords = $clientsKeywords;
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
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
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param mixed $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @return mixed
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * @param mixed $ordering
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @return mixed
     */
    public function getReklama()
    {
        return $this->reklama;
    }

    /**
     * @param mixed $reklama
     */
    public function setReklama($reklama)
    {
        $this->reklama = $reklama;
    }

    /**
     * @return mixed
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param mixed $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }

    /**
     * @return mixed
     */
    public function getRubric()
    {
        return $this->rubric;
    }

    /**
     * @param mixed $rubric
     */
    public function setRubric($rubric)
    {
        $this->rubric = $rubric;
    }

    /**
     * @return mixed
     */
    public function getFi()
    {
        return $this->fi;
    }

    /**
     * @param mixed $fi
     */
    public function setFi($fi)
    {
        $this->fi = $fi;
    }

    /**
     * @return mixed
     */
    public function getClientIndex()
    {
        return $this->clientIndex;
    }

    /**
     * @param mixed $clientIndex
     */
    public function setClientIndex($clientIndex)
    {
        $this->clientIndex = $clientIndex;
    }

    /**
     * @return mixed
     */
    public function getRubricDescription()
    {
        return $this->rubricDescription;
    }

    /**
     * @param mixed $rubricDescription
     */
    public function setRubricDescription($rubricDescription)
    {
        $this->rubricDescription = $rubricDescription;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTels()
    {
        return $this->tels;
    }

    /**
     * @param mixed $tels
     */
    public function setTels($tels)
    {
        $this->tels = $tels;
    }

    /**
     * @return mixed
     */
    public function getContent2()
    {
        return $this->content2;
    }

    /**
     * @param mixed $content2
     */
    public function setContent2($content2)
    {
        $this->content2 = $content2;
    }

}
