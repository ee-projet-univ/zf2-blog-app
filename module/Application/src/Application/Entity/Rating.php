<?php
namespace Application\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity
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
     * @\Doctrine\ORM\Mapping\OneToOne(targetEntity="Application\Entity\User")
     * @\Doctrine\ORM\Mapping\JoinTable(name="ratings_users",
     *      joinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="rating_id", referencedColumnName="id")},
     *      inverseJoinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    protected $user;

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
     * Get user name.
     *
     * @return string
     */
    public function getUserName()
    {
        // TODO: Return user name, not user ID (JOIN ON User)
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
