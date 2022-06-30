<?php
namespace Customer\Mrc\Model;

class CodeModules
{
    protected $moduleList;
    protected $moduleReader;

    public function __construct(
        \Magento\Framework\Module\ModuleList $moduleList,
        \Magento\Framework\Module\Dir\Reader $moduleReader
    ) {
        $this->moduleList = $moduleList;
        $this->moduleReader = $moduleReader;
    }

    public function getCustomModules()
    {
        $result = [];

        $modules = $this->moduleList->getNames();
        
        foreach ($modules as $_module) {
            $dir = $this->moduleReader->getModuleDir(null, $_module);
            if(strpos($dir, 'app/code') !== false)
            {
                $result[] = $_module;
            }
        }

        return 'kkk';
    }
}
