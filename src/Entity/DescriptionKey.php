<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\ManyToOne(targetEntity="JosClientsKeywords", inversedBy="keyss")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id") // исправить на id_inc
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="title_key", type="string")
     */
    private $titleKey;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=180)
     * @Assert\Length(
     *      max = 180,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов"
     * )
     */
    private $description;

    private $position;

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
     * @return string
     */
    public function getTitleKey()
    {
        return $this->titleKey;
    }

    /**
     * @param string $titleKey
     */
    public function setTitleKey($titleKey)
    {
        $this->titleKey = $titleKey;
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

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

}
