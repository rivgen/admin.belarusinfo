<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="banners_key")
 * @ORM\Entity
 */
class BannersKey
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="JosBanners", inversedBy="key")
     */
    private $josBanners;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=45)
     */
    private $tag;

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
    public function getJosBanners()
    {
        return $this->josBanners;
    }

    /**
     * @param mixed $josBanners
     */
    public function setJosBanners($josBanners)
    {
        $this->josBanners = $josBanners;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag(string $tag)
    {
        $this->tag = $tag;
    }

}
