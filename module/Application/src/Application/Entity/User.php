<?php

namespace Application\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="\Application\Repository\UserRepository")
 * @\Doctrine\ORM\Mapping\Table(name="users")
 */
class User implements \ZfcUser\Entity\UserInterface, \BjyAuthorize\Provider\Role\ProviderInterface
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
    protected $username;

    /**
     * @var string
     * @\Doctrine\ORM\Mapping\Column(type="string", unique=true,  length=255)
     */
    protected $email;

    /**
     * @var string
     * @\Doctrine\ORM\Mapping\Column(type="string", length=50, nullable=true)
     */
    protected $displayName;

    /**
     * @var string
     * @\Doctrine\ORM\Mapping\Column(type="string", length=128)
     */
    protected $password;

    /**
     * @var int
     */
    protected $state;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @\Doctrine\ORM\Mapping\ManyToMany(targetEntity="Application\Entity\Role")
     * @\Doctrine\ORM\Mapping\JoinTable(name="users_roles",
     *      joinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@\Doctrine\ORM\Mapping\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    protected $roles;

    /**
     * Initialies the roles variable.
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
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
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username.
     *
     * @param string $sUsername
     *
     * @return void
     */
    public function setUsername($sUsername)
    {
        $this->username = $sUsername;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $sEmail
     *
     * @return void
     */
    public function setEmail($sEmail)
    {
        $this->email = $sEmail;
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set displayName.
     *
     * @param string $sDisplayName
     *
     * @return void
     */
    public function setDisplayName($sDisplayName)
    {
        $this->displayName = $sDisplayName;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return void
     */
    public function setPassword($sPassword)
    {
        $this->password = $sPassword;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state.
     *
     * @param int $sState
     *
     * @return void
     */
    public function setState($sState)
    {
        $this->state = $sState;
    }

    /**
     * Get role.
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles->getValues();
    }

    /**
     * Add a role to the user.
     *
     * @param \Application\Entity\Role $oRole
     *
     * @return void
     */
    public function addRole(\Application\Entity\Role $oRole)
    {
        $this->roles[] = $oRole;
    }
}
