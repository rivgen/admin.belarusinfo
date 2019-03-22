<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JosContent
 *
 * @ORM\Table(name="jos_clients_land")
 * @ORM\Entity
 */
class ClientsLand
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
     *
     * @ORM\Column(name="client_id")
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="card_url", type="string")
     */
    private $cardUrl;

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
     * @return
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getCardUrl()
    {
        return $this->cardUrl;
    }

    /**
     * @param string $cardUrl
     */
    public function setCardUrl($cardUrl)
    {
        $this->cardUrl = $cardUrl;
    }

}
