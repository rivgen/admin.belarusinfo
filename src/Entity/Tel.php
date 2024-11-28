<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tel
 *
 * @ORM\Table(name="tel")
 * @ORM\Entity
 */
class Tel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="client_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $client;
    
    /**
     * @ORM\ManyToOne(targetEntity="JosAdminClients", inversedBy="tels")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id_inc")
     */
    private $company;


    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer")
     */
    private $ordering;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_type", type="string")
     */
    private $phoneType;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string")
     */
    private $phone;

//    /**
//     * @ORM\ManyToOne(targetEntity="JosAdminClients", inversedBy="tel")
//     */
//    private $company;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }
    
    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }


    /**
     * @return int
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * @param int $ordering
     */
    public function setOrdering(int $ordering)
    {
        $this->ordering = $ordering;
    }

    /**
     * @return null|string
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }

    /**
     * @param null|string $phoneType
     */
    public function setPhoneType(string $phoneType)
    {
        $this->phoneType = $phoneType;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

}
