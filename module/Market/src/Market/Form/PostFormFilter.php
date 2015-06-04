<?php
namespace Market\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\InputFilter\FileInput;
use Zend\Filter\StripTags;
use Zend\Filter\StringTrim;
use Zend\Filter\StringToLower;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\StringLength;
use Zend\Validator\InArray;
use Zend\Validator\Regex;
use Market\Form\Filter\Float;


/**
 *
 * @author Minello
 *        
 */
class PostFormFilter extends InputFilter {
	use CategoryTrait;
	use ExpireDaysTrait;

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
		
		
/*
		$photo = new Input('photo_filename');
		$photo->getFilterChain()
		->attachByName('StripTags')
		->attachByName('StringTrim');
		
		$photo->getValidatorChain()
		->attachByName('Regex', array('pattern' => '!^(http://)?[a-z0-9./_-]+(jp(e)?g|png)$!i'));
		$photo->setErrorMessage('Photo must be a URL or a valid filename ending with jpg or png');
*/		
		$photo = new FileInput('photo_filename');
		$photo->getValidatorChain()
			  ->attach(new \Zend\Validator\File\UploadFile());
		$photo->getFilterChain()
			  ->attach(new \Zend\Filter\File\RenameUpload(array(
		         'target'    => __DIR__.'../../../../data/upload/',
		         'randomize' => true,
		     )));
//		$photo->setErrorMessage('Photo must be a URL or a valid filename ending with jpg or png');
		
		$price = new Input('price');
		$price->setAllowEmpty(true);
		$price->getValidatorChain()
			  ->addByName('GreaterThan', array('min' => 0.00));
		$price->getFilterChain()
			  ->attach(new Float());
		
		$expires = new Input('expires');
		$expires->setAllowEmpty(true);
		$expires->getValidatorChain()
				->attachByName('InArray', array('haystack' => array_keys($this->getExpireDays())));
		$expires->getFilterChain()
				->attachByName('StripTags')
				->attachByName('StringTrim');
		
		$city = new Input('city');
		$city->setAllowEmpty(true);
		$city->getFilterChain()
			 ->attachByName('StripTags')
			 ->attachByName('StringTrim');
		
		$name = new Input('contact_name');
		$name->setAllowEmpty(true);
		$name->getValidatorChain()
			 ->attachByName('Regex', array('pattern' => '/^[a-z0-9., -]{1,255}$/i'));
		$name->setErrorMessage('Name should only contain letters, numbers, and some punctuation.');
		$name->getFilterChain()
			 ->attachByName('StripTags')
			 ->attachByName('StringTrim');
		
		$phone = new Input('contact_phone');
		$phone->setAllowEmpty(true);
		$phone->getValidatorChain()
//			  ->attachByName('Regex', array('pattern' => '/^\+?\d{1,4}(-\d{3,4})+$/'));
			  ->attachByName('Regex', array('pattern' => '/^(\(11\) [9][0-9]{4}-[0-9]{4})|(\(1[2-9]\) [5-9][0-9]{3}-[0-9]{4})|(\([2-9][1-9]\) [5-9][0-9]{3}-[0-9]{4})$/'));
//		$phone->setErrorMessage('Phone number must be in this format: +nnnn-nnn-nnn-nnnn');
		$phone->setErrorMessage('Telefone deve estar no formato: (99) 99999-9999 ou (99) 9999-9999');
		$phone->getFilterChain()
			  ->attachByName('StripTags')
			  ->attachByName('StringTrim');
		
		$email = new Input('contact_email');
		$email->setAllowEmpty(true);
		$email->getValidatorChain()
			  ->attachByName('EmailAddress');
		$email->getFilterChain()
			  ->attachByName('StripTags')
			  ->attachByName('StringTrim');
		
		$description = new Input('description');
		$description->setAllowEmpty(true);
		$description->getValidatorChain()
					->attachByName('StringLength', array('min' => 1, 'max' => 4096));
		$description->getFilterChain()
					->attachByName('StripTags')
					->attachByName('StringTrim');
		
		$delCode = new Input('delete_code');
		$delCode->setRequired(true);
		$delCode->getValidatorChain()
				->addByName('Digits');
		
		$this->add($category)
			 ->add($title)
			 ->add($photo)
			 ->add($price)
			 ->add($expires)
			 ->add($city)
			 ->add($name)
			 ->add($phone)
			 ->add($email)
			 ->add($description)
			 ->add($delCode);
	}

	public function setCategories($categories) {
		$this->categories = $categories;
	}
}