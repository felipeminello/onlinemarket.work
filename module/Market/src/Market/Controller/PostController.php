<?php
namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\Zend\View\Model;
/**
 *
 * @author Minello
 *        
 */
class PostController extends AbstractActionController
{
    public $categories;
    
    public function setCategorires(array $categories) {
        $this->categories = $categories;
    }
    
    public function indexAction() {
        $vm = new ViewModel(['categories' => $this->categories]);
        $vm->setTemplate('market/post/invalid.phtml');
        
        return $vm;
    }
}
