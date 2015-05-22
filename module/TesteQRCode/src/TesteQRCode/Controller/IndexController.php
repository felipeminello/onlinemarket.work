<?php

namespace TesteQRCode\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Acelaya\QrCode\Service\QrCodeService;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $service = $this->getServiceLocator();
        
        
        
        //$content = $service->getQrCodeContent('http://www.alejandrocelaya.com/contact', 'png');
        
        return new ViewModel();
    }


    
}

