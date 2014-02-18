<?php
namespace Application\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity
 * @\Doctrine\ORM\Mapping\Table(name="comment")
 */
class Comment
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
     * @\Doctrine\ORM\Mapping\JoinTable(name="comments_users",
     *      joinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="comment_id", referencedColumnName="id")},
     *      inverseJoinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    protected $author;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="Application\Entity\Post")
     * @\Doctrine\ORM\Mapping\JoinTable(name="comments_posts",
     *      joinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="comment_id", referencedColumnName="id")},
     *      inverseJoinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="post_id", referencedColumnName="id")}
     * )
     */
    protected $post;

    /**
     * @var datetime
     * @\Doctrine\ORM\Mapping\Column(type="datetime", nullable=false)
     */
    protected $date_create;

    /**
     * @var datetime
     * @\Doctrine\ORM\Mapping\Column(type="datetime", nullable=false)
     */
    protected $date_edit;

    /**
     * @var boolean
     * @\Doctrine\ORM\Mapping\Column(type="boolean", nullable=false)
     */
    protected $is_deleted;

    /**
     * @var text
     * @\Doctrine\ORM\Mapping\Column(type="text", nullable=false)
     */
    protected $content;

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
     * Get author id.
     *
     * @return int
     */
    public function getAuthorId()
    {
        return $this->author;
    }

    /**
     * Set author id.
     *
     * @param int $sAuthorId
     *
     * @return void
     */
    public function setAuthorId($sAuthorId)
    {
        $this->author = (int) $sAuthorId;
    }

    /**
     * Get date of creation.
     *
     * @return datetime
     */
    public function getDateCreate()
    {
        return $this->date_create;
    }

    /**
     * Set date of creation.
     *
     * @param date $dDateCreate
     *
     * @return void
     */
    public function setDateCreate($dDateCreate)
    {
        $this->date_create = $dDateCreate;
    }

    /**
     * Get date of latest edit.
     *
     * @return datetime
     */
    public function getDateEdit()
    {
        return $this->date_edit;
    }

    /**
     * Set date of latest edit.
     *
     * @param date $dDateEdit
     *
     * @return void
     */
    public function setDateEdit($dDateEdit)
    {
        $this->date_edit = $dDateEdit;
    }

    /**
     * Returns whether a comment is deleted or not
     *
     * @return boolean
     */
    public function isDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * Delete a comment or undelete it
     *
     * @param boolean $bDeleted
     *
     * @return void
     */
    public function setDeleted($bDeleted)
    {
        $this->is_deleted = $bDeleted;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content.
     *
     * @param string $sContent
     *
     * @return void
     */
    public function setContent($sContent)
    {
        $this->content = $sContent;
    }
}
