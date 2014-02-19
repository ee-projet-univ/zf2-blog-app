<?php

namespace Application\Form;

class CommentForm extends \Zend\Form\Form
{
    public function __construct($sName, $aOptions = array())
    {
        parent::__construct($sName, $aOptions);
        $content = new \Zend\Form\Element\Textarea('content');
        $content->setLabel('Contenu de votre commentaire :')
                ->setAttributes(array('required' => true));

        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Ajouter');
        $submit->setAttributes(array('class' => 'btn btn-primary'));

        $this->add($content)->add($submit);
    }
}