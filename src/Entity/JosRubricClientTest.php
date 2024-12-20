<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class JosRubricClientTest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="rubric_description", type="text", nullable=true)
     */
    private $rubricDescription;

    /**
     * @ORM\Column(name="client_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $client;
    
    /**
     * @ORM\ManyToOne(targetEntity="JosAdminClients", inversedBy="rubrics")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id_inc")
     */
    private $company;
    /**
     *
     * @ORM\ManyToOne(targetEntity="JosRubric", inversedBy="old")
     */
    private $newRubric;

    /**
     * @ORM\Column(name="new_rubric_id", type="integer")
     */
    private $newRubricId;

    /**
     * @ORM\Column(name="ordering", type="integer", nullable=true)
     */
    private $ordering;

    /**
     * @ORM\Column(name="published", type="integer", nullable=true)
     */
    private $published;

    /**
     * @ORM\Column(name="rubric_id", type="integer")
     */
    private $rubricId;

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
    public function getNewRubric()
    {
        return $this->newRubric;
    }

    /**
     * @param mixed $newRubric
     */
    public function setNewRubric($newRubric)
    {
        $this->newRubric = $newRubric;
    }

    /**
     * @return mixed
     */
    public function getNewRubricId()
    {
        return $this->newRubricId;
    }

    /**
     * @param mixed $newRubricId
     */
    public function setNewRubricId($newRubricId)
    {
        $this->newRubricId = $newRubricId;
    }

    /**
     * @return mixed
     */
    public function getRubricId()
    {
        return $this->rubricId;
    }

    /**
     * @param mixed $rubricId
     */
    public function setRubricId($rubricId)
    {
        $this->rubricId = $rubricId;
    }

}
