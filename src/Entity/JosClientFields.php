<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JosContent
 *
 * @ORM\Table(name="jos_client_fields", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"client"})})
 * @ORM\Entity
 */
class JosClientFields
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
     * @var int
     *
     * @ORM\Column(name="client", type="integer", nullable=false, unique=true)
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="fb", type="string")
     */
    private $fb;

    /**
     * @var string
     *
     * @ORM\Column(name="gps", type="string")
     */
    private $gps;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string")
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="news", type="string")
     */
    private $news;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram", type="string")
     */
    private $instagram;

    /**
     * @var string
     *
     * @ORM\Column(name="ok", type="string")
     */
    private $ok;

    /**
     * @var string
     *
     * @ORM\Column(name="vk", type="string")
     */
    private $vk;

    /**
     * @var string
     *
     * @ORM\Column(name="tripadvisor", type="string")
     */
    private $tripadvisor;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube", type="string")
     */
    private $youtube;

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
    public function getFb()
    {
        return $this->fb;
    }

    /**
     * @param string $fb
     */
    public function setFb($fb)
    {
        $this->fb = $fb;
    }

    /**
     * @return string
     */
    public function getGps()
    {
        return $this->gps;
    }

    /**
     * @param string $gps
     */
    public function setGps($gps)
    {
        $this->gps = $gps;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * @param string $instagram
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;
    }

    /**
     * @return string
     */
    public function getOk()
    {
        return $this->ok;
    }

    /**
     * @param string $ok
     */
    public function setOk($ok)
    {
        $this->ok = $ok;
    }

    /**
     * @return string
     */
    public function getVk()
    {
        return $this->vk;
    }

    /**
     * @param string $vk
     */
    public function setVk($vk)
    {
        $this->vk = $vk;
    }

    /**
     * @return string
     */
    public function getTripadvisor()
    {
        return $this->tripadvisor;
    }

    /**
     * @param string $tripadvisor
     */
    public function setTripadvisor($tripadvisor)
    {
        $this->tripadvisor = $tripadvisor;
    }

    /**
     * @return string
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * @param string $youtube
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;
    }

    /**
     * @return int
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param int $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * @param string $news
     */
    public function setNews($news)
    {
        $this->news = $news;
    }

}
