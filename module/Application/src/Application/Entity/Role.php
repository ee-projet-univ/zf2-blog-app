<?php
namespace Application\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity
 * @\Doctrine\ORM\Mapping\Table(name="role")
 */
class Role implements \BjyAuthorize\Acl\HierarchicalRoleInterface
{
    /**
     * @var int
     * @\Doctrine\ORM\Mapping\Id
     * @\Doctrine\ORM\Mapping\Column(type="integer")
     * @\Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @\Doctrine\ORM\Mapping\Column(type="string", length=255, unique=true, nullable=true)
     */
    protected $roleId;

    /**
     * @var Role
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="Application\Entity\Role")
     */
    protected $parent;

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
        $this->id = (int)$sId;
    }

    /**
     * Get the role id.
     *
     * @return string
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set the role id.
     *
     * @param string $sRoleId
     *
     * @return void
     */
    public function setRoleId($sRoleId)
    {
        $this->roleId = (string) $sRoleId;
    }

    /**
     * Get the parent role
     *
     * @return \Application\Entity\Role
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent role.
     *
     * @param \Application\Entity\Role $parent
     *
     * @return void
     */
    public function setParent(\Application\Entity\Role $oParent)
    {
        $this->parent = $oParent;
    }
}
