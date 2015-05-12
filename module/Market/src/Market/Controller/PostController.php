<?php
namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
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
        return new ViewModel(['categories' => $this->categories]);
    }
}
