<?php
namespace Market\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Filter\StripTags;
use Zend\Filter\StringTrim;
use Zend\Filter\StringToLower;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\StringLength;
use Zend\Validator\InArray;
use Zend\Validator\Regex;


/**
 *
 * @author Minello
 *        
 */
class PostFormFilter extends InputFilter {
	private $categories;

	public function buildFilter() {
		$in = new InArray();
		$in->setHaystack($this->categories);
		
		$category = new Input('category');
		$category->getFilterChain()
				 ->attach(new StripTags())
				 ->attach(new StringTrim())
				 ->attach(new StringToLower);
		$category->getValidatorChain()
				 ->attach($in);
		
		$title = new Input('title');
		$title->getFilterChain()
			  ->attach(new StripTags)
			  ->attach(new StringTrim);
		$title->getValidatorChain()
			  ->attach(new Alnum)
			  ->attach(new StringLength);
		
		$titleRegex = new Regex(['pattern' => '/^[a-zA-Z0-9 ]*$/']);
		$titleRegex->setMessage('O título deve conter números, letras ou espaços');
		
		$titleStringLengh = new StringLength();
		$titleStringLengh->setMin(1);
		$titleStringLengh->setMax(128);
		
		$title->getValidatorChain()
			  ->attach($titleRegex)
			  ->attach($titleStringLengh);
		
		$this->add($category)->add($title);
	}

	public function setCategories($categories) {
		$this->categories = $categories;
	}
}