<?php

namespace Application\Factory\Form;

class CommentFormFactory implements \Zend\ServiceManager\FactoryInterface
{

    /**
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     * @param  \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
     * @return \Application\Form\CommentForm
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator) {
        $oForm = new \Application\Form\CommentForm('comment');
        return $oForm->setInputFilter(new \Application\InputFilter\CommentInputFilter());
    }

}
