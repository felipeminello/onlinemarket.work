<?php
namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;
/**
 *
 * @author Minello
 *        
 */
class LeftLinks extends AbstractHelper
{
    public function __invoke(array $values, $urlPrefix)
    {
        $output = '<ul class="list-group">'.PHP_EOL;
        
        foreach ($values as $value) {
            $output .= '<li class="list-group-item"><a href="'.$urlPrefix.'/'.$value.'">'.$value.'</a></li>'.PHP_EOL;
        }
        
        $output .= '</ul>'.PHP_EOL;
        
        return $output;
    }
}
