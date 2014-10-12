<?php

namespace Cz\Projet00Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="downloadedFiles")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class filmDownloader
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDownloaded", type="boolean", nullable=false)
     */
    protected $downloaded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dowloadDate", type="datetime", nullable=false)
     */
    protected $downloadDate;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    protected $path;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    protected $comment;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function isDownloaded()
    {
        return $this->downloaded;
    }

    public function setDowloaded($downloaded)
    {
        $this->downloaded = $downloaded;
    }

    public function getDownloadDate()
    {
        return $this->downloadDate;
    }

    public function setDownloadDate($date)
    {
        $this->downloadDate = $date;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($torrentPath)
    {
        $this->path = $torrentPath;
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'../Resources/public/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/torrents';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if ($this->file !== NULL)
            $this->path = sha1(uniqid(mt_rand(), TRUE)).'.'.$this->file->guessExtension();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (NULL === $this->file)
            return ;
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        $this->path = $this->file->getClientOriginalName();
        $this->file = NULL;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath())
            unlink($file);
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }
}

?>