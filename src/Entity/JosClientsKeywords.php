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
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="JosContent", mappedBy="companytitle")
     */
    private $content;

    /**
     * @ORM\OneToOne(targetEntity="JosAdminClients", mappedBy="clientsKeywords")
     *
     */
    private $adminClients;

    /**
     * @ORM\OneToMany(targetEntity="DescriptionKey", mappedBy="company")
     */
    private $keyss;

    /**
     * @return mixed
     */
    public function getAdminClients()
    {
        return $this->adminClients;
    }

    /**
     * @param mixed $adminClients
     */
    public function setAdminClients($adminClients)
    {
        $this->adminClients = $adminClients;
    }

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

}
