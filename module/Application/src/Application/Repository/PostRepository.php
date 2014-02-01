<?php
namespace Application\Repository;

class PostRepository extends \Doctrine\ORM\EntityRepository {
    /**
     * @param \Application\Entity\PostEntity $oEntity
     * @return \Application\Entity\PostEntity
     */
    public function create(\Application\Entity\PostEntity $oEntity) {
        /*$this->_em->persist($oEntity->setAuthorId($id)
                ->setDateCreate(new \DateTime())->setDateEdit(new \DateTime())
                ->setDeleted(false)->setTitle($title)->setContent($content));
        $this->_em->flush();*/
        return $oEntity;
    }

    /**
     * @param \Application\Entity\PostEntity $oEntity
     * @return \Application\Entity\PostEntity
     */
    public function update(\Application\Entity\PostEntity $oEntity){
        //$oEntity->setEntityUpdate(new \DateTime());
        //$this->_em->flush();
        return $oEntity;
    }

    /**
     * @param \Application\Entity\PostEntity $oEntity
     * @return \Application\Entity\PostEntity
     */
    public function remove(\Application\Entity\PostEntity $oEntity){
        //$this->_em->remove($oEntity);
        $this->_em->flush();
        return $oEntity;
    }
}
