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
        /**
         * Pega a categoria de uma QueryString
         * EX: /onlinemarket.work/public/market/market-view-controller/index?category=teste
         */
//        $category = $this->params()->fromQuery('category');
        
        
        /**
         * Pega a categoria de uma Rota
         * EX: /onlinemarket.work/public/market/view/main/teste
         */
        $category = $this->params()->fromRoute('category');
        
        return new ViewModel(['category' => $category]);
    }
    
    public function itemAction()
    {
        /**
         * Pega a categoria de uma QueryString
         * EX: /onlinemarket.work/public/market/market-view-controller/item?itemId=123
         */
//        $itemId = $this->params()->fromQuery('itemId');
        
        /**
         * Pega a categoria de uma QueryString
         * EX: /onlinemarket.work/public/market/market-view-controller/item?itemId=123
         */
        $itemId = $this->params()->fromRoute('itemId');
        
        if (empty($itemId)) {
//            $this->redirect()->toRoute('market');
//            $this->redirect()->toUrl('http://minello.com.br');
            $this->flashMessenger()->addMessage('Item not found');
            
            return $this->redirect()->toRoute('market');
        }
        
        return new ViewModel(['itemId' => $itemId]);
    }
}
