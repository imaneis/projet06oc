<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="text")
     */
    private $Content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Author;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Upload your image")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image1;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Upload your image")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image2;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Upload your image")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image3;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Upload your image")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image4;

    /**
     * @ORM\Column(type="text")
     */
    private $video;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->Author;
    }

    public function setAuthor(string $Author): self
    {
        $this->Author = $Author;

        return $this;
    }

    public function getImage1()
    {
        return $this->image1;
    }

    public function setImage1($image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2()
    {
        return $this->image2;
    }

    public function setImage2($image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3()
    {
        return $this->image3;
    }

    public function setImage3($image3): self
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getImage4()
    {
        return $this->image4;
    }

    public function setImage4($image4): self
    {
        $this->image4 = $image4;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}