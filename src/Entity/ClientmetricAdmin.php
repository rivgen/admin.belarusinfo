<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Admin\CategoryproductAdmin;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Table(name="msmetric")
 * @ORM\Entity
 */
class ClientmetricAdmin
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="client_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="JosAdminClients", inversedBy="tels")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id_inc")
     */
    private $company;

    /**
     * @ORM\Column(name="msmetric", type="string", length=64, nullable=true)
     */
    private $msmetric;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getMsmetric(): ?string
    {
        return $this->msmetric;
    }

    public function setMsmetric(?string $msmetric): self
    {
        $this->msmetric = $msmetric;

        return $this;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {

        if (null === $this->getFile()) {
            return;
        }
        $c_rand = uniqid(mt_rand(), true);

        $image_file = $this->getUploadRootDir().'/'.$c_rand.'.'.$this->getFile()->guessExtension();
        $image_file_to_db = $c_rand.'.'.$this->getFile()->guessExtension();

        if(move_uploaded_file($this->getFile(),$image_file)){

            if(file_exists($this->getImage())){
                unlink($this->getImage());
            }

            $this->setImage('uploads/'.$this->image_folder.'/'.$image_file_to_db);
        }

        $this->file = null;



//        exit();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->image
            ? null
            : $this->getUploadRootDir().'/'.$this->image;
    }

    public function getWebPath()
    {
        return null === $this->image
            ? null
            : $this->getUploadDir().'/'.$this->image;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return  $_SERVER['DOCUMENT_ROOT']. '/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
//        return 'uploads/'.$this->image_folder.'';

        return 'belarusinfo.by/ms_assets/uploads/'.$this->image_folder.'';
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }
}
