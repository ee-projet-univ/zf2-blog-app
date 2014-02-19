<?php
namespace Application\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="\Application\Repository\TagRepository")
 * @\Doctrine\ORM\Mapping\Table(name="tag")
 */
class Tag
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
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="Application\Entity\Post")
     * @\Doctrine\ORM\Mapping\JoinTable(name="tags_posts",
     *      joinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="tag_id", referencedColumnName="id")},
     *      inverseJoinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="post_id", referencedColumnName="id")}
     * )
     */
    protected $post;

    /**
     * @var string
     * @\Doctrine\ORM\Mapping\Column(type="string", length=30, nullable=false)
     */
    protected $name;

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
     * @param \Application\Entity\Post $sPostId
     *
     * @return void
     */
    public function setPost($sPost)
    {
        $this->post = $sPost;
    }

    /**
     * Get tag name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set tag name.
     *
     * @param string $sName
     *
     * @return void
     */
    public function setName($sName)
    {
        $this->name = $sName;
    }
}
