<?php

namespace App\Entity;


/**
 * @ORM\Entity()
 */
class JosRubric
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"api"})
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="text", nullable=false)
     * @Groups({"api"})
     */
    private $name;

    /**
     * @ORM\Column(name="keywords", type="text", nullable=false)
     * @Groups({"api"})
     */
    private $keywords = ' ';

    /**
     * @ORM\Column(name="description", type="text", nullable=false)
     * @Groups({"api"})
     *
     */
    private $description = ' ';

    /**
     * @ORM\Column(name="`key`", type="text", nullable=false)
     * @Groups({"api"})
     */
    private $key = ' ';
//
    /**
     * @ORM\Column(name="key_w", type="text", nullable=false)
     * @Groups({"api"})
     */
    private $keyW = ' ';

    /**
     * @ORM\Column(name="title", type="text", nullable=false)
     * @Groups({"api"})
     */
    private $title = ' ';

    /**
     * @ORM\Column(name="seo_text", type="text", nullable=false)
     * @Groups({"api"})
     */
    private $seoText = ' ';

    /**
     * @ORM\Column(name="seo_key", type="text", nullable=false)
     * @Groups({"api"})
     */
    private $seoKey = ' ';

    /**
     * @ORM\ManyToOne(targetEntity="JosRubric", inversedBy="id")
     */
    private $parent;

    /**
     * @ORM\Column(name="level", type="integer", nullable=false)
     * @Groups({"api"})
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity="JosRubricClientTest", mappedBy="newRubric")
     */
    private $old;

    /**
     * @ORM\Column(name="old_id", type="integer", nullable=false)
     */
    private $oldId;

    /**
     * @ORM\Column(name="published", type="integer", nullable=false)
     * @Groups({"api"})
     */
    private $published;

    /**
     * @ORM\Column(name="alias", type="string", nullable=false)
     * @Groups({"api"})
     */
    private $alias;

    /**
     * @ORM\Column(name="created", type="datetime", nullable=false)
     * @Groups({"api"})
     */
    private $created;

    /**
     * @ORM\Column(name="modified", type="datetime", nullable=false)
     * @Groups({"api"})
     */
    private $modified;


    /**
     * @ORM\OneToMany(targetEntity="JosBanners", mappedBy="rubric")
     */
    private $banners;

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
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getOld()
    {
        return $this->old;
    }

    /**
     * @param mixed $old
     */
    public function setOld($old)
    {
        $this->old = $old;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
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

//    /**
//     * @return mixed
//     */
//    public function getRubricClient()
//    {
//        return $this->rubricClient;
//    }
//
//    /**
//     * @param mixed $rubricClient
//     */
//    public function setRubricClient($rubricClient)
//    {
//        $this->rubricClient = $rubricClient;
//    }

    /**
     * @return mixed
     */
    public function getBanners()
    {
        return $this->banners;
    }

    /**
     * @param mixed $banners
     */
    public function setBanners($banners)
    {
        $this->banners = $banners;
    }

    /**
     * @return mixed
     */
    public function getOldId()
    {
        return $this->oldId;
    }

    /**
     * @param mixed $oldId
     */
    public function setOldId($oldId)
    {
        $this->oldId = $oldId;
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
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getKeyW()
    {
        return $this->keyW;
    }

    /**
     * @param mixed $keyW
     */
    public function setKeyW($keyW)
    {
        $this->keyW = $keyW;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSeoText()
    {
        return $this->seoText;
    }

    /**
     * @param mixed $seoText
     */
    public function setSeoText($seoText)
    {
        $this->seoText = $seoText;
    }

    /**
     * @return mixed
     */
    public function getSeoKey()
    {
        return $this->seoKey;
    }

    /**
     * @param mixed $seoKey
     */
    public function setSeoKey($seoKey)
    {
        $this->seoKey = $seoKey;
    }

}
