<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Admin\CategoryproductAdmin;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Table(name="msfilials")
 * @ORM\Entity
 */
class FilialAdmin
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="JosAdminClients", inversedBy="tels")
     */
    private $client;

    /**
     * One Company has One Company in relation.
     * @OneToOne(targetEntity="JosAdminClients")
     * @JoinColumn(name="filial_id", referencedColumnName="id")
     */
    private $filial_id;


    public function getId(): ?int
    {
        return $this->id;
    }



    public function getFilialId()
    {
        return $this->filial_id;
    }

    public function setFilialId($filial_id)
    {
        $this->filial_id = $filial_id;

        return $this;
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


}