<?php
namespace Application\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="\Application\Repository\RatingRepository")
 * @\Doctrine\ORM\Mapping\Table(name="rating")
 */
class Rating
{
    /**
     * @var int
     * @\Doctrine\ORM\Mapping\Id
     * @\Doctrine\ORM\Mapping\Column(type="integer")
     * @\Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="Application\Entity\User")
     * @\Doctrine\ORM\Mapping\JoinTable(name="ratings_users",
     *      joinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="rating_id", referencedColumnName="id")},
     *      inverseJoinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    protected $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="Application\Entity\Post")
     * @\Doctrine\ORM\Mapping\JoinTable(name="ratings_posts",
     *      joinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="rating_id", referencedColumnName="id")},
     *      inverseJoinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="post_id", referencedColumnName="id")}
     * )
     */
    protected $post;

    /**
     * @var smallint
     * @\Doctrine\ORM\Mapping\Column(type="smallint", nullable=true)
     */
    protected $value;
    
    /**
     * Get the id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id.
     *
     * @param int $sId
     *
     * @return void
     */
    public function setId($sId)
    {
        $this->id = (int) $sId;
    }

    /**
     * Get user.
     *
     * @return \Application\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user.
     *
     * @param \Application\Entity\User $sUser
     *
     * @return void
     */
    public function setUser($sUser)
    {
        $this->user = $sUser;
    }

    /**
     * Get post.
     *
     * @return \Application\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set post.
     *
     * @param \Application\Entity\Post $sPost
     *
     * @return void
     */
    public function setPost($sPost)
    {
        $this->post = $sPost;
    }
    
    /**
     * Get rating value.
     *
     * @return smallint
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set rating value.
     *
     * @param smallint $sValue
     *
     * @return void
     */
    public function setValue($sValue)
    {
        $this->value = (int) $sValue;
    }
}
