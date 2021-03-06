<?php
namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Market\Form\PostForm;
use Zend\Http\PhpEnvironment\Request;

use Zend\Form\Form;
/**
 *
 * @author Minello
 *        
 */
class PostController extends AbstractActionController
{
    public $categories;
    public $postForm;
    
    use ListingsTableTrait;
    
    public function setCategorires(array $categories) {
        $this->categories = $categories;
    }
    
    public function setPostForm($postForm) {
    	$this->postForm = $postForm;
    }
    
    public function indexAction() {
    	$r = new Request();
    	
    	$post = $this->params()->fromPost();
    	$photo = $r->getFiles()->toArray();
    	    	
    	$data = array_merge_recursive($post, $photo);
    	
    	$renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
    	$renderer->headScript()->appendFile('/js/meiomask.min.js');
    	
//    	$this->getViewHelper('HeadScript')->appendFile('./js/meiomask.min.js');
    	
        $vm = new ViewModel(['categories' => $this->categories, 'postForm' => $this->postForm, 'data' => $data]);
        $vm->setTemplate('market/post/index.phtml');
        
        if ($this->getRequest()->isPost()) {
        	$this->postForm->setData($data);

        	if ($this->postForm->isValid()) {

        		$this->listingsTable->addPosting($this->postForm->getData());
        		
        		$this->flashMessenger()->addMessage('Obrigado por postar');
        		$this->redirect()->toRoute('home');
        	} else {
        		foreach ($this->postForm->getInputFilter()->getInvalidInput() as $error) {
        			print_r ($error->getMessages());
        		}
        		$invalidView = new ViewModel();
        		$invalidView->setTemplate('market/post/invalid.phtml');
        		$invalidView->addChild($vm, 'main');
        		
        		return $invalidView;
        	}
        }
        
        return $vm;
    }
}
