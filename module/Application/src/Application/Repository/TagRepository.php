<?php

namespace Application\Repository;

class TagRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Save post entity into db
     * @param \Application\Entity\Tag $oTagEntity
     * @return \Application\Entity\Tag
     */
    public function createTagEntity(\Application\Entity\Tag $oTagEntity) {
        $this->_em->persist($oTagEntity);
        $this->_em->flush();

        return $oTagEntity;
    }

}
