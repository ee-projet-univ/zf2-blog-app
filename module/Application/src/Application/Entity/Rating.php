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
     * @var datetime
     * @\Doctrine\ORM\Mapping\Column(type="datetime", nullable=false)
     */
    protected $date;

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
     * Get user id.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user;
    }

    /**
     * Set user id.
     *
     * @param int $sUserId
     *
     * @return void
     */
    public function setUserId($sUserId)
    {
        $this->user = (int) $sUserId;
    }

    /**
     * Get post id.
     *
     * @return int
     */
    public function getPostId()
    {
        return $this->post;
    }

    /**
     * Set post id.
     *
     * @param int $sPostId
     *
     * @return void
     */
    public function setPostId($sPostId)
    {
        $this->post = (int) $sPostId;
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
