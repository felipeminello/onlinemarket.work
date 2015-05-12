<?php
namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
/**
 *
 * @author Minello
 *        
 */
class ViewController extends AbstractActionController
{
    public function indexAction()
    {
        $category = $this->params()->fromQuery('category');
        
        return new ViewModel(['category' => $category]);
    }
    
    public function itemAction()
    {
        $itemId = $this->params()->fromQuery('itemId');
        
        if (empty($itemId)) {
//            $this->redirect()->toRoute('market');
//            $this->redirect()->toUrl('http://minello.com.br');
            $this->flashMessenger()->addMessage('Item not found');
            
            return $this->redirect()->toRoute('market');
        }
        
        return new ViewModel(['itemId' => $itemId]);
    }
}
