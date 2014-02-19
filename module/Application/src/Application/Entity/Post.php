<?php

namespace Application\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="\Application\Repository\PostRepository")
 * @\Doctrine\ORM\Mapping\Table(name="post")
 */
class Post {

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
     * @\Doctrine\ORM\Mapping\JoinTable(name="posts_users",
     *      joinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="post_id", referencedColumnName="id")},
     *      inverseJoinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    protected $author;

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
     * @var string
     * @\Doctrine\ORM\Mapping\Column(type="string", length=255, nullable=false)
     */
    protected $title;

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set the id.
     *
     * @param int $sId
     *
     * @return void
     */
    public function setId($sId) {
        $this->id = (int) $sId;
    }

    /**
     * Get author.
     *
     * @return \Application\Entity\User
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Set author.
     *
     * @param \Application\Entity\User $sAuthor
     *
     * @return void
     */
    public function setAuthor($sAuthor) {
        $this->author = $sAuthor;
    }

    /**
     * Get date of creation.
     *
     * @return datetime
     */
    public function getDateCreate() {
        // TODO: Format date with functions (date() or use an external module?)
        return $this->date_create;
    }

    /**
     * Set date of creation.
     *
     * @param date $dDateCreate
     *
     * @return void
     */
    public function setDateCreate($dDateCreate) {
        $this->date_create = $dDateCreate;
    }

    /**
     * Get date of latest edit.
     *
     * @return datetime
     */
    public function getDateEdit() {
        return $this->date_edit;
    }

    /**
     * Set date of latest edit.
     *
     * @param date $dDateEdit
     *
     * @return void
     */
    public function setDateEdit($dDateEdit) {
        $this->date_edit = $dDateEdit;
    }

    /**
     * Returns whether a post is deleted or not
     *
     * @return boolean
     */
    public function isDeleted() {
        return $this->is_deleted;
    }

    /**
     * Delete a post or undelete it
     *
     * @param boolean $bDeleted
     *
     * @return void
     */
    public function setDeleted($bDeleted) {
        $this->is_deleted = $bDeleted;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $sTitle
     *
     * @return void
     */
    public function setTitle($sTitle) {
        $this->title = $sTitle;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set content.
     *
     * @param string $sContent
     *
     * @return void
     */
    public function setContent($sContent) {
        $this->content = $sContent;
    }

}
