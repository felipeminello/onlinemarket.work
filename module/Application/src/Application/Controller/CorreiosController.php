<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

/**
 *
 * @author Minello
 *        
 */
class CorreiosController extends AbstractActionController
{

    public function indexAction()
    {
        $sm = $this->getServiceLocator();
        $estados = $sm->get('estados');
        
        return new ViewModel([
            'estados' => $estados
        ]);
    }

    public function buscaAction()
    {
        $cep = $this->params()->fromPost('cep');
        
        // Possíveis formatos (json, xml, query, object, array)
        // null = \InfanaticaCepModule\Response\EnderecoResponse
        
        $serviceLocator = $this->getServiceLocator();
        $cepService = $serviceLocator->get('InfanaticaCepModule\Service\CepService');
        $endereco = $cepService->getEnderecoByCep($cep, 'array');
        
        $return = json_encode($endereco);
        
        return new JsonModel($endereco);
    }
}
