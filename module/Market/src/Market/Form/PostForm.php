<?php
namespace Market\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Captcha\Dumb;
use Zend\Captcha\Image as ImageCaptcha;

class PostForm extends Form {
	private $categories;

	public function setCategories($categories) {
		$this->categories = $categories;
	}

	public function buildForm() {
		$this->setAttribute('method', 'POST');
		
		$category = new Element\Select('category');
		$category->setLabel('Category')
				 ->setValueOptions(array_combine($this->categories, $this->categories));
		
		$title = new Element\Text('title');
		$title->setLabel('Title')->setAttributes(array(
				'size' => 60,
				'maxLength' => 128,
				'required' => 'required',
				'placeholder' => 'Listing header' 
		));
		
		$price  = new Element\Number('price');
		$price->setLabel('Price')->setAttributes(array(
				'required' => 'required'
		));
		
		
//		$submit = new Element\Submit('enviar');
//		$submit->setValue('Enviar');
		
		$submit = array(
			'name' => 'submit',
			'type' => 'button',
			'attributes' => array(
				'type'  => 'submit',
				'value' => 'Enviar',
				'id' => 'submitbutton',
				'class' => 'btn btn-default',
			),
			'options' => array('label' => 'Submit')
		);
		
//		$captcha = new Element\Captcha('captcha');
//		$captcha->setCaptcha(new Dumb);
//		$captcha->setOption('label', 'Você é humano?');
		
//		$csrf = new Element\Csrf('seguranca');
		
		$this->add($category)->add($title)->add($price)->add($submit);
	}
}