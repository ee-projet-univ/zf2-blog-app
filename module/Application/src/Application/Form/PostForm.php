<?php
namespace Application\Form;

class PostForm extends \Zend\Form\Form {
    /**
     * @see \Zend\Form\Form::prepare()
     */
    public function prepare() {
        if($this->isPrepared) return $this;

        $this->add(array(
            'name' => 'title',
            'type' => 'text',
            'attributes' => array(
                'required' => true,
                'autocomplete' => 'off',
                'autofocus' => 'autofocus',
                'class' => 'required'
            )
        ))->add(array(
            'name' => 'content',
            'type' => 'textarea',
            'attributes' => array(
                'required' => true,
                'autocomplete' => 'off',
                'class' => 'required'
            )
        ))->add(array(
            'name' => 'submit',
            'attributes' => array(
            'type' => 'submit',
                'value' => 'register',
                'class' => 'btn-large btn-primary',
                'disabled' => true
            ),
            'options' => array(
            'ignore' => true,
                'twb' => array('formAction' => true)
            )
        ));

        return parent::prepare();
    }
}
