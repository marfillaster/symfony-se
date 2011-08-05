<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Symfony\Bundle\DoctrinePHPCRBundle\DoctrinePHPCRBundle(),
            new Marfs\CRMBundle\MarfsCRMBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            //$bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new JMS\DebuggingBundle\JMSDebuggingBundle($this);
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        if (file_exists(__DIR__.'/config/parameters.ini')) {
            $loader->load(__DIR__.'/config/parameters.ini');
        } else {
            $loader->load(__DIR__.'/config/pagoda.parameters.ini');
        }
        
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
    
    protected function getContainerBaseClass()
    {
    	if (in_array($this->getEnvironment(), array('dev', 'test'))) {
    		return '\JMS\DebuggingBundle\DependencyInjection\TraceableContainer';
    	}
    
    	return parent::getContainerBaseClass();
    }
}
