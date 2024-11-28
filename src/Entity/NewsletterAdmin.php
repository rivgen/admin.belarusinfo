<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @ORM\Table(name="msnewsletters")
 * @ORM\Entity
 */
class NewsletterAdmin
{




    protected $imageName;

    // protected $path = 'uploads/news';

    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $file;
    protected $path;

//    private $newsletteradmin;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

//    /**
//     * @ORM\Column(type="string", length=255, nullable=true)
//     */
//    private $name;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(name="client_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="JosAdminClients", inversedBy="news")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id_inc")
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meta_title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meta_desc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $published;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ordering;

    /**
     * @ORM\Column(type="string", length=24, nullable=true)
     */
    private $showonindex;



    private $uploadDir;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $date;



    public function __construct(KernelInterface $kernel)
    {
        $this->uploadDir = $kernel->getProjectDir();
//        $this->date = date('d-m-Y');
    }



    public function getId(): ?int
    {
        return $this->id;
    }

//    public function getName(): ?string
//    {
//        return $this->name;
//    }
//
//    public function setName(?string $name): self
//    {
//        $this->name = $name;
//
//        return $this;
//    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->meta_title;

    }

    public function setMetaTitle(?string $meta_title): self
    {
        $this->meta_title = $meta_title;

        return $this;
    }

    public function getMetaDesc(): ?string
    {
        return $this->meta_desc;
    }

    public function setMetaDesc(?string $meta_desc): self
    {
        $this->meta_desc = $meta_desc;

        return $this;
    }

    public function getPublished(): ?string
    {
        return $this->published;
    }

    public function setPublished(?string $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getOrdering(): ?string
    {
        return $this->ordering;
    }

    public function setOrdering(?string $ordering): self
    {
        $this->ordering = $ordering;

        return $this;
    }

    public function getShowonindex(): ?string
    {
        return $this->showonindex;
    }

    public function setShowonindex(?string $showonindex): self
    {
        $this->showonindex = $showonindex;

        return $this;
    }


    /*
        public function getAbsolutePath()
        {
            return null === $this->imageName ? null : $this->getUploadRootDir().'/'.$this->imageName;
        }

        public function getWebPath()
        {
            return null === $this->imageName ? null : $this->getUploadDir().'/'.$this->imageName;
        }

        protected function getUploadRootDir($basepath)
        {
            // the absolute directory path where uploaded documents should be saved
            return $basepath.$this->getUploadDir();
        }

        protected function getUploadDir()
        {
            // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
            return 'uploads/news';
        }

        public function upload($basepath)
        {
            // the file property can be empty if the field is not required
            if (null === $this->image) {
                return;
            }

            if (null === $basepath) {
                return;
            }

            // we use the original file name here but you should
            // sanitize it at least to avoid any security issues

            // move takes the target directory and then the target filename to move to
            $this->file->move($this->getUploadRootDir($basepath), $this->file->getClientOriginalName());

            // set the path property to the filename where you'ved saved the file
            $this->setImageName($this->file->getClientOriginalName());

            // clean up the file property as you won't need it anymore
            $this->file = null;
        }
    */


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
//        var_dump($this->path.'<br/>');
//        var_dump($this->getWebPath().'<br/>');
//        var_dump($_SERVER['DOCUMENT_ROOT'].'<br/>');
//        var_dump($this->getName().'.'.$this->getFile()->guessExtension().'<br/>');
//        var_dump(sha1(uniqid(mt_rand(), true).'.'.$this->getFile()->guessExtension().'<br/>'));
//        var_dump($this->getFile().'<br/>');
//        var_dump($this->getUploadRootDir().'<br/>');
//        var_dump($this->getFile().'<br/>');
//        var_dump($this->getFile().'<br/>');
//        var_dump($this->getUploadRootDir().'/'.$this->getName().'.'.$this->getFile()->guessExtension().'<br/>');
        if (null === $this->getFile()) {
            return;
        }
        $c_rand = uniqid(mt_rand(), true);

        $image_file = $this->getUploadRootDir().'/'.$c_rand.'.'.$this->getFile()->guessExtension();
        $image_file_to_db = $c_rand.'.'.$this->getFile()->guessExtension();
//        $image_file_to_db = $this->getId().'.'.$this->getFile()->guessExtension();
//        move_uploaded_file($this->getFile(), $this->getUploadRootDir());
//        var_dump($this->getFile()->move($this->getUploadRootDir(), $this->image).'<br/>');
//        var_dump(move_uploaded_file($this->getFile(), $this->getUploadRootDir().'/'.$this->getName().'.'.$this->getFile()->guessExtension()));
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
//        if (file_exists($image_file)) {
//            unlink($image_file);
//        }

        if(move_uploaded_file($this->getFile(),$image_file)){

            if(file_exists($this->getImage())){
                unlink($this->getImage());
            }


            $this->setImage('uploads/news/'.$image_file_to_db);
        }
        //$this->getFile()->move($this->getUploadRootDir(), $this->image);

        // check if we have an old image
//        if (isset($this->temp)) {
//            // delete the old image
//            unlink($this->getUploadRootDir().'/'.$this->temp);
//            // clear the temp image path
//            $this->temp = null;
//        }


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
//        return __DIR__.'/../../../../web/'.$this->getUploadDir();
//        return $basepath.$this->getUploadDir();
//        return  $this->uploadDir. '/public/'.$this->getUploadDir();
        return  $_SERVER['DOCUMENT_ROOT']. '/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'belarusinfo.by/ms_assets/uploads/news';
//        return 'uploads/news';
    }


    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;
       // $this->date = ($date === null || $date === '') ? date('d-m-Y') : $date;

        return $this;
    }
}
