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

        $content = new \Zend\Form\Element\Textarea('content');
        $content->setLabel('Contenu')
                ->setAttributes(array('required' => true));

        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Créer');
        $submit->setAttributes(array('class' => 'btn btn-primary'));

        $this->add($content)->add($submit);

        return parent::prepare();
    }

}