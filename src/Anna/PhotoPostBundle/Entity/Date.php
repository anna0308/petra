<?php

namespace Anna\PhotoPostBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Date
 *
 * @ORM\Table(name="date")
 * @ORM\Entity(repositoryClass="Anna\PhotoPostBundle\Repository\DateRepository")
 */
class Date
{
    /**
     * Many Dates have Many Posts.
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="posts")
     */
    private $posts;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", unique=true)
     */
    private $postId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $date;


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
     * Set postId
     *
     * @param integer $postId
     *
     * @return Date
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get postId
     *
     * @return int
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Date
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    public function __construct() {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add post
     *
     * @param \Anna\PhotoPostkBundle\Entity\Post $post
     *
     * @return Post
     */
    public function addPost($post)
    {
        $this->posts[] = $post;
        return $this;
    }
    /**
     * Remove post
     *
     * @param \Anna\PhotoPostkBundle\Entity\Post $post
     */
    public function removePost(\Anna\PhotoPostkBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }
    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
    /**
     * Set posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function setPosts($posts= null)
    {
        return $this->posts = $posts;
    }
}

