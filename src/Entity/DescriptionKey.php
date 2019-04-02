<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DescriptionKey
 *
 * @ORM\Table(name="description_key")
 * @ORM\Entity
 */
class DescriptionKey
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

//    /**
//     * @ORM\ManyToOne(targetEntity="JosContent", inversedBy="descriptionKeys")
//     */
//    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="JosClients", inversedBy="keys")
     */
    private $company;

    /**
     * @var string|null
     *
     * @ORM\Column(name="keys", type="text", length=65535, nullable=true)
     */
    private $keys;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=180, nullable=true)
     */
    private $description;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @param int $companyId
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * @return null|string
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * @param null|string $keys
     */
    public function setKeys($keys)
    {
        $this->keys = $keys;
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


}
