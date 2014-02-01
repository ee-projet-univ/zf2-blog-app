<?php
namespace Application\InputFilter;
class PostInputFilter extends \Zend\InputFilter\InputFilter {
    /**
     * Constructor
     */
    public function __construct(\Application\Repository\PostRepository $oPostRepository) {
        $this->add(array(
            'name' => 'title',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim'))
        ))->add(array(
            'name' => 'content',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim'))
        ));
    }
}