<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="link")
 * @ORM\Entity
 */
class Link
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer", nullable=true)
     */
    private $count;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_data", type="datetime")
     */
    private $updateData;

    /**
     * @var int
     *
     * @ORM\Column(name="count_two", type="integer", nullable=true)
     */
    private $countTwo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_data_two", type="datetime")
     */
    private $updateDataTwo;



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
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateData(): \DateTime
    {
        return $this->updateData;
    }

    /**
     * @param \DateTime $updateData
     */
    public function setUpdateData(\DateTime $updateData)
    {
        $this->updateData = $updateData;
    }

    /**
     * @return int
     */
    public function getCount2(): int
    {
        return $this->count2;
    }

    /**
     * @param int $count2
     */
    public function setCount2(int $count2)
    {
        $this->count2 = $count2;
    }

    /**
     * @return int
     */
    public function getCountTwo(): int
    {
        return $this->countTwo;
    }

    /**
     * @param int $countTwo
     */
    public function setCountTwo(int $countTwo)
    {
        $this->countTwo = $countTwo;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDataTwo(): \DateTime
    {
        return $this->updateDataTwo;
    }

    /**
     * @param \DateTime $updateDataTwo
     */
    public function setUpdateDataTwo(\DateTime $updateDataTwo)
    {
        $this->updateDataTwo = $updateDataTwo;
    }

}
