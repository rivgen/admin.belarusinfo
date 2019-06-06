<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="jos_clients_keywords")
 * @ORM\Entity()
 */
class JosClientsKeywords
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="keywords", type="text", nullable=true)
     */
    private $keywords;

    /**
     * @ORM\OneToMany(targetEntity="JosContent", mappedBy="companytitle")
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="DescriptionKey", mappedBy="company")
     */
    private $keyss;

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
    public function getKeyss()
    {
        return $this->keyss;
    }

    /**
     * @param mixed $keyss
     */
    public function setKeyss($keyss)
    {
        $this->keyss = $keyss;
    }

}
