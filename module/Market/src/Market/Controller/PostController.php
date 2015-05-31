<?php
namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Market\Form\PostForm;
/**
 *
 * @author Minello
 *        
 */
class PostController extends AbstractActionController
{
    public $categories;
    public $postForm;
    
    public function setCategorires(array $categories) {
        $this->categories = $categories;
    }
    
    public function setPostForm($postForm) {
    	$this->postForm = $postForm;
    }
    
    public function indexAction() {
    	
    	$data = $this->params()->fromPost();
    	
        $vm = new ViewModel(['categories' => $this->categories, 'postForm' => $this->postForm, 'data' => $data]);
        $vm->setTemplate('market/post/index.phtml');
        
        if ($this->getRequest()->isPost()) {
        	$this->postForm->setData($data);
        	
        	if ($this->postForm->isValid()) {
        		$this->flashMessenger()->addMessage('Obrigado por postar');
        		$this->redirect()->toRoute('home');
        	} else {
        		$invalidView = new ViewModel();
        		$invalidView->setTemplate('market/post/invalid.phtml');
        		$invalidView->addChild($vm, 'main');
        		
        		return $invalidView;
        	}
        }
        
        return $vm;
    }
}
