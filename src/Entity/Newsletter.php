<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="newsletter")
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
class Newsletter
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="news_title", type="string", length=255, nullable=true)
     */
    private $newsTitle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="company_id", type="integer", nullable=true)
     */
    private $companyId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="news_rubric", type="integer", nullable=true)
     */
    private $newsRubric;

    /**
     * @var int|null
     *
     * @ORM\Column(name="published", type="integer", nullable=true)
     */
    private $published;

    /**
     * @var string|null
     *
     * @ORM\Column(name="introtext", type="text", length=16777215, nullable=true)
     */
    private $introtext;

    /**
     * @var string|null
     *
     * @ORM\Column(name="full_text", type="text", length=16777215, nullable=true)
     */
    private $fullText;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ordering", type="integer", nullable=true)
     */
    private $ordering;

    /**
     * @var string|null
     *
     * @ORM\Column(name="metakey", type="text", length=16777215, nullable=true)
     */
    private $metakey;

    /**
     * @var string|null
     *
     * @ORM\Column(name="metadesc", type="text", length=16777215, nullable=true)
     */
    private $metadesc;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="NewsRubric", inversedBy="news")
     */
    private $catid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="alias", type="string", length=255, nullable=true)
     */
    private $alias;

    /**
     * @var string|null
     *
     * @ORM\Column(name="autor", type="string", length=25, nullable=true)
     */
    private $autor;

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
     * @return null|string
     */
    public function getNewsTitle()
    {
        return $this->newsTitle;
    }

    /**
     * @param null|string $newsTitle
     */
    public function setNewsTitle($newsTitle)
    {
        $this->newsTitle = $newsTitle;
    }

    /**
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @param int|null $companyId
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * @return int|null
     */
    public function getNewsRubric()
    {
        return $this->newsRubric;
    }

    /**
     * @param int|null $newsRubric
     */
    public function setNewsRubric($newsRubric)
    {
        $this->newsRubric = $newsRubric;
    }

    /**
     * @return int|null
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param int|null $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return null|string
     */
    public function getIntrotext()
    {
        return $this->introtext;
    }

    /**
     * @param null|string $introtext
     */
    public function setIntrotext($introtext)
    {
        $this->introtext = $introtext;
    }

    /**
     * @return null|string
     */
    public function getFullText()
    {
        return $this->fullText;
    }

    /**
     * @param null|string $fullText
     */
    public function setFullText($fullText)
    {
        $this->fullText = $fullText;
    }

    /**
     * @return int|null
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * @param int|null $ordering
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
    }

    /**
     * @return null|string
     */
    public function getMetakey()
    {
        return $this->metakey;
    }

    /**
     * @param null|string $metakey
     */
    public function setMetakey($metakey)
    {
        $this->metakey = $metakey;
    }

    /**
     * @return null|string
     */
    public function getMetadesc()
    {
        return $this->metadesc;
    }

    /**
     * @param null|string $metadesc
     */
    public function setMetadesc($metadesc)
    {
        $this->metadesc = $metadesc;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime|null $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime|null $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return int|null
     */
    public function getCatid()
    {
        return $this->catid;
    }

    /**
     * @param int|null $catid
     */
    public function setCatid($catid)
    {
        $this->catid = $catid;
    }

    /**
     * @return null|string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param null|string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return null|string
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param null|string $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }


}
