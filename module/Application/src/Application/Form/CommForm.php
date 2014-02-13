<?php

namespace Application\Form;

class CommForm extends \Zend\Form\Form
{

    /**
     * @see \Zend\Form\Form::prepare()
     */
    public function prepare() {
        if ($this->isPrepared)
            return $this;

        $title = new \Zend\Form\Element\Text('title');
        $title->setLabel('Postez un commentaire');

        $content = new \Zend\Form\Element\Textarea('content');
        $content->setLabel('Contenu')
                ->setAttributes(array('required' => true));

        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Créer');
        $submit->setAttributes(array('class' => 'btn btn-primary'));

        $this->add($title)->add($content)->add($submit);

        return parent::prepare();
    }

}