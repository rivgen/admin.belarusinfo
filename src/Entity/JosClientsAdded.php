<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="jos_clients_added")
 * @ORM\Entity(repositoryClass="App\Repository\JosClientsAddedRepository")
 */
class JosClientsAdded
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"api"})
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="JosRubric")
     * @ORM\JoinColumn(name="rubric", referencedColumnName="id")
     * @Groups({"api"})
     */
    private $rubric;

    /**
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $city;

    /**
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $address;

    /**
     * @ORM\Column(name="house", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $house;

    /**
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $phone;

    /**
     * @ORM\Column(name="keywords", type="text", nullable=true)
     * @Groups({"api"})
     */
    private $keywords;

    /**
     * @ORM\Column(name="about", type="text", nullable=true)
     * @Groups({"api"})
     */
    private $about;

    /**
     * @ORM\Column(name="created", type="datetime")
     * @Groups({"api"})
     */
    private $created;

    /**
     * @ORM\Column(name="date", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $date;

    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $email;

    /**
     * @ORM\Column(name="unp", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $unp;

    /**
     * @ORM\Column(name="site", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $site;

    /**
     * @ORM\Column(name="zip", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $zip;

    /**
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $status;

    /**
     * @ORM\Column(name="contact_name", type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $contactName;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function setName($name): void
    {
        $this->name = $name;
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
    public function setRubric($rubric): void
    {
        $this->rubric = $rubric;
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
    public function setCity($city): void
    {
        $this->city = $city;
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
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * @param mixed $house
     */
    public function setHouse($house): void
    {
        $this->house = $house;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords): void
    {
        $this->keywords = $keywords;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @param mixed $about
     */
    public function setAbout($about): void
    {
        $this->about = $about;
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
    public function setCreated($created): void
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
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
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUnp()
    {
        return $this->unp;
    }

    /**
     * @param mixed $unp
     */
    public function setUnp($unp): void
    {
        $this->unp = $unp;
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
    public function setSite($site): void
    {
        $this->site = $site;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * @param mixed $contactName
     */
    public function setContactName($contactName): void
    {
        $this->contactName = $contactName;
    }


}
