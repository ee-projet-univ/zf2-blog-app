<?php
namespace Application\Factory\Form;
class PostFormFactory implements \Zend\ServiceManager\FactoryInterface {
    /**
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
     * @return \Application\Form\PostForm
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
        $oForm = new \Application\Form\PostForm('post');
        return $oForm->setInputFilter(new \Application\InputFilter\PostInputFilter(
            $oServiceLocator->get('Application\Repository\PostRepository')
        ))->prepare();
    }
}
