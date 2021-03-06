<?php

namespace Application\Form;

class PostForm extends \Zend\Form\Form
{
    public function __construct($sName, $aOptions = array())
    {
        parent::__construct($sName, $aOptions);
        $title = new \Zend\Form\Element\Text('title');
        $title->setLabel('Titre')
                ->setAttributes(array('required' => true));

        $content = new \Zend\Form\Element\Textarea('content');
        $content->setLabel('Contenu')
                ->setAttributes(array('required' => true));

        $tag = new \Zend\Form\Element\Text('tag');
        $tag->setLabel('Tags (séparés par une espace)')
                ->setAttributes(array('required' => true));

        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Créer');
        $submit->setAttributes(array('class' => 'btn btn-primary'));

        $this->add($title)->add($content)->add($tag)->add($submit);
    }
}
