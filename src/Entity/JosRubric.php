<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class JosRubric
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="JosRubric", inversedBy="id")
     */
    private $parent;

    /**
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity="JosRubricClientTest", mappedBy="newRubric")
     */
    private $old;

    /**
     * @ORM\Column(name="published", type="integer", nullable=false)
     */
    private $published;

    /**
     * @ORM\Column(name="alias", type="string", nullable=false)
     */
    private $alias;

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

    /**
     * @return mixed
     */
    public function getRubricClient()
    {
        return $this->rubricClient;
    }

    /**
     * @param mixed $rubricClient
     */
    public function setRubricClient($rubricClient)
    {
        $this->rubricClient = $rubricClient;
    }

    /**
     * @return mixed
     */
    public function getOldd()
    {
        return $this->oldd;
    }

    /**
     * @param mixed $oldd
     */
    public function setOldd($oldd)
    {
        $this->oldd = $oldd;
    }

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

}
