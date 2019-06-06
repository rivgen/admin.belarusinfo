<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JosContent
 *
 * @ORM\Table(name="jos_content", indexes={@ORM\Index(name="idx_access", columns={"access"}), @ORM\Index(name="idx_state", columns={"state"}), @ORM\Index(name="idx_createdby", columns={"created_by"}), @ORM\Index(name="idx_section", columns={"sectionid"}), @ORM\Index(name="idx_checkout", columns={"checked_out"}), @ORM\Index(name="idx_catid", columns={"catid"})})
 * @ORM\Entity(repositoryClass="App\Repository\JosContentRepository")
 * @ORM\Entity
 */
class JosContent
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="JosAdminClients", inversedBy="content")
     */
    private $companytitle;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="title_alias", type="string", length=255)
     */
    private $titleAlias;

    /**
     * @var string
     *
     * @ORM\Column(name="introtext", type="text", length=16777215)
     */
    private $introtext;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="fulltext", type="text", length=16777215)
//     */
//    private $fulltext;

    /**
     * @var bool
     *
     * @ORM\Column(name="state", type="boolean")
     */
    private $state;

    /**
     * @var int
     *
     * @ORM\Column(name="sectionid", type="integer")
     */
    private $sectionid;

    /**
     * @var int
     *
     * @ORM\Column(name="mask", type="integer", options={"unsigned"=true})
     */
    private $mask = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="catid", type="integer")
     */
    private $catid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer")
     */
    private $createdBy;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="admin_created", type="string", length=50, nullable=false)
//     */
//    private $adminCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by_alias", type="string", length=255)
     */
    private $createdByAlias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;

    /**
     * @var int
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $modifiedBy = "";

    /**
     * @var int
     *
     * @ORM\Column(name="checked_out", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $checkedOut = "0";

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checked_out_time", type="datetime")
     */
    private $checkedOutTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_up", type="datetime")
     */
    private $publishUp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_down", type="datetime")
     */
    private $publishDown;

    /**
     * @var string
     *
     * @ORM\Column(name="images", type="text", length=65535)
     */
    private $images;

    /**
     * @var string
     *
     * @ORM\Column(name="urls", type="text", length=65535)
     */
    private $urls;

    /**
     * @var string
     *
     * @ORM\Column(name="attribs", type="text", length=65535, nullable=false, options={"unsigned"=true})
     */
    private $attribs = 'show_title=
link_titles=
show_intro=
show_section=
link_section=
show_category=
link_category=
show_vote=
show_author=
show_create_date=
show_modify_date=
show_pdf_icon=
show_print_icon=
show_email_icon=
language=
keyref=
readmore=';

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer")
     */
    private $version;

    /**
     * @var int
     *
     * @ORM\Column(name="parentid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $parentid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer")
     */
    private $ordering;

    /**
     * @var string
     *
     * @ORM\Column(name="metakey", type="text", length=65535)
     */
    private $metakey;

    /**
     * @var string
     *
     * @ORM\Column(name="metadesc", type="text", length=65535)
     */
    private $metadesc;

    /**
     * @var int
     *
     * @ORM\Column(name="access", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $access = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="hits", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $hits = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="metadata", type="text", length=65535,  nullable=false, options={"unsigned"=true})
     */
    private $metadata = 'robots=
author=';

    /**
     * @ORM\OneToMany(targetEntity="DescriptionKey", mappedBy="content")
     */
    private $descriptionKeys;

    /**
     * @return int
     */
    public function getModifiedId()
    {
        return $this->modifiedId;
    }

    /**
     * @param int $modifiedId
     */
    public function setModifiedId($modifiedId)
    {
        $this->modifiedId = $modifiedId;
    }

    /**
     * @return int
     */
    public function getCreatedId()
    {
        return $this->createdId;
    }

    /**
     * @param int $createdId
     */
    public function setCreatedId($createdId)
    {
        $this->createdId = $createdId;
    }

    /**
     * @return mixed
     */
    public function getDescriptionKeys()
    {
        return $this->descriptionKeys;
    }

    /**
     * @param mixed $descriptionKeys
     */
    public function setDescriptionKeys($descriptionKeys)
    {
        $this->descriptionKeys = $descriptionKeys;
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int|null
     */
    public function getTitleId()
    {
        return $this->titleId;
    }

    /**
     * @param int|null $titleId
     */
    public function setTitleId($titleId)
    {
        $this->titleId = $titleId;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getTitleAlias()
    {
        return $this->titleAlias;
    }

    /**
     * @param string $titleAlias
     */
    public function setTitleAlias($titleAlias)
    {
        $this->titleAlias = $titleAlias;
    }

    /**
     * @return string
     */
    public function getIntrotext()
    {
        return $this->introtext;
    }

    /**
     * @param string $introtext
     */
    public function setIntrotext($introtext)
    {
        $this->introtext = $introtext;
    }

    /**
     * @return string
     */
    public function getFulltext()
    {
        return $this->fulltext;
    }

    /**
     * @param string $fulltext
     */
    public function setFulltext($fulltext)
    {
        $this->fulltext = $fulltext;
    }

    /**
     * @return bool
     */
    public function isState()
    {
        return $this->state;
    }

    /**
     * @param bool $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getSectionid()
    {
        return $this->sectionid;
    }

    /**
     * @param int $sectionid
     */
    public function setSectionid($sectionid)
    {
        $this->sectionid = $sectionid;
    }

    /**
     * @return int
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * @param int $mask
     */
    public function setMask($mask)
    {
        $this->mask = $mask;
    }

    /**
     * @return int
     */
    public function getCatid()
    {
        return $this->catid;
    }

    /**
     * @param int $catid
     */
    public function setCatid($catid)
    {
        $this->catid = $catid;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return string
     */
    public function getCreatedByAlias()
    {
        return $this->createdByAlias;
    }

    /**
     * @param string $createdByAlias
     */
    public function setCreatedByAlias($createdByAlias)
    {
        $this->createdByAlias = $createdByAlias;
    }

    /**
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param \DateTime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @return int
     */
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    /**
     * @param int $modifiedBy
     */
    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return int
     */
    public function getCheckedOut()
    {
        return $this->checkedOut;
    }

    /**
     * @param int $checkedOut
     */
    public function setCheckedOut($checkedOut)
    {
        $this->checkedOut = $checkedOut;
    }

    /**
     * @return \DateTime
     */
    public function getCheckedOutTime()
    {
        return $this->checkedOutTime;
    }

    /**
     * @param \DateTime $checkedOutTime
     */
    public function setCheckedOutTime($checkedOutTime)
    {
        $this->checkedOutTime = $checkedOutTime;
    }

    /**
     * @return \DateTime
     */
    public function getPublishUp()
    {
        return $this->publishUp;
    }

    /**
     * @param \DateTime $publishUp
     */
    public function setPublishUp($publishUp)
    {
        $this->publishUp = $publishUp;
    }

    /**
     * @return \DateTime
     */
    public function getPublishDown()
    {
        return $this->publishDown;
    }

    /**
     * @param \DateTime $publishDown
     */
    public function setPublishDown($publishDown)
    {
        $this->publishDown = $publishDown;
    }

    /**
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param string $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @param string $urls
     */
    public function setUrls($urls)
    {
        $this->urls = $urls;
    }

    /**
     * @return string
     */
    public function getAttribs()
    {
        return $this->attribs;
    }

    /**
     * @param string $attribs
     */
    public function setAttribs($attribs)
    {
        $this->attribs = $attribs;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return int
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * @param int $parentid
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;
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
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
    }

    /**
     * @return string
     */
    public function getMetakey()
    {
        return $this->metakey;
    }

    /**
     * @param string $metakey
     */
    public function setMetakey($metakey)
    {
        $this->metakey = $metakey;
    }

    /**
     * @return string
     */
    public function getMetadesc()
    {
        return $this->metadesc;
    }

    /**
     * @param string $metadesc
     */
    public function setMetadesc($metadesc)
    {
        $this->metadesc = $metadesc;
    }

    /**
     * @return int
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param int $access
     */
    public function setAccess($access)
    {
        $this->access = $access;
    }

    /**
     * @return int
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @param int $hits
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }

    /**
     * @return string
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param string $metadata
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * @return string
     */
    public function getAdminCreated()
    {
        return $this->adminCreated;
    }

    /**
     * @param string $adminCreated
     */
    public function setAdminCreated($adminCreated)
    {
        $this->adminCreated = $adminCreated;
    }

    /**
     * @return int|null
     */
    public function getCompanytitle()
    {
        return $this->companytitle;
    }

    /**
     * @param int|null $companytitle
     */
    public function setCompanytitle($companytitle)
    {
        $this->companytitle = $companytitle;
    }


}
