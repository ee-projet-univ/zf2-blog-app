<?php

namespace Application\InputFilter;

class CommentInputFilter extends \Zend\InputFilter\InputFilter
{

    /**
     * Constructor
     */
    public function __construct() {
        $this->add(array(
            'name' => 'content',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim'))
        ));
    }

}
