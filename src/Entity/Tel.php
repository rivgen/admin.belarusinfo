<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tel
 *
 * @ORM\Table(name="Tel")
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
     * @ORM\ManyToOne(targetEntity="JosAdminClients", inversedBy="tels")
     */
    private $client;

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
     * @return int
     */
    public function getOrdering(): int
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
     * @return string
     */
    public function getPhoneType(): string
    {
        return $this->phoneType;
    }

    /**
     * @param string $phoneType
     */
    public function setPhoneType(string $phoneType)
    {
        $this->phoneType = $phoneType;
    }

    /**
     * @return string
     */
    public function getPhone(): string
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
