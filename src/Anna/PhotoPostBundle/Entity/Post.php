<?php

namespace Anna\PhotoPostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Anna\PhotoPostBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * Many Posts have Many Dates.
     * @Assert\NotBlank()
     * @ORM\ManyToMany(targetEntity="Date",inversedBy="posts" ,cascade={"persist"})
     * @ORM\JoinTable(name="dates")
     */
    private $dates;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=500)
     */
    private $image;

    /**
     * @var integer
     * 
     * @ORM\Column(type="integer")
     */
    private $vote;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Post
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Post
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getVote()
    {
        return $this->vote;
    }


    public function setVote($vote)
    {
        $this->vote = $vote;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dates = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add date
     *
     * @param \Anna\PhotoPostBundle\Entity\Date $date
     *
     * @return Date
     */

    public function addDate(\Anna\PhotoPostBundle\Entity\Date $date)
    {
        if($this->dates->contains($date)){
            return;
        }
        return $this->dates[] = $date;
    }
    /**
     * Remove date
     *
     * @param \Anna\PhotoPostBundle\Entity\Date $date
     */
    public function removeDate(\Hs\PhoneBookBundle\Entity\Phone $phone)
    {
        $this->phones->removeElement($phone);
    }
    /**
     * Get dates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDates()
    {
        return $this->dates;
    }
     /**
     * Set dates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function setDates($dates = null)
    {
        return $this->dates = $dates;
    }

}
