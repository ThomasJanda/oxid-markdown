<?php
namespace rs\markdown\Application\Controller\Admin;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class rs_markdown extends \OxidEsales\Eshop\Application\Controller\Admin\AdminController
{
    protected $_sThisTemplate = 'rs_markdown.tpl';
    
    protected $_oModule = null;
    
    public function render()
    {
	$myConfig = $this->getConfig();
        $request = oxNew(Request::class);

        if ( $request->getRequestEscapedParameter("moduleId")) {
            $sModuleId = $request->getRequestEscapedParameter("moduleId");
        } else {
            $sModuleId = $this->getEditObjectId();
        }
        
        $oModule = oxNew('oxModule');
        if ( $sModuleId ) {
            if ( $oModule->load( $sModuleId ) ) {
                $this->_oModule = $oModule;
            } else {
                \OxidEsales\Eshop\Core\Registry::get("oxUtilsView")->addErrorToDisplay( new \OxidEsales\Eshop\Core\Exception\StandardException('EXCEPTION_MODULE_NOT_LOADED') );
            }
        }
        
        return parent::render();
    }
    
    public function getReadmeAsHtml()
    {
        if($this->getReadmeFileName())
        {
            $readmeRaw  = file_get_contents($this->getReadmeFileName());

            $parser = new \Michelf\MarkdownExtra();
            $parser->url_filter_func = [$this, 'transformUrl'];
            return $parser->transform($readmeRaw);

        }
        
        return false;
    }

    public function transformUrl($sUrl)
    {
        $oConfig = $this->getConfig();
        $sUrl = $oConfig->getConfigParam('sShopURL').$oConfig->getModulesDir(false).$this->_oModule->getModulePath() . '/'.$sUrl;
        return $sUrl;
    }
    
    public function getReadmeFileName()
    {
        $oConfig = $this->getConfig();
        $absModUrl      =  $oConfig->getModulesDir(true).$this->_oModule->getModulePath() . '/';
        $editlangAbbr = Registry::getLang()->getLanguageAbbr($this->_iEditLang);
        
        $mdFiles = glob($absModUrl . '*.md');
        
        $localFilename = strtolower($absModUrl.'readme_' . $editlangAbbr . '.md');
        $defaultFilename = strtolower($absModUrl.'readme.md');
        
        $defaultReadme = false;
        
        foreach($mdFiles as $file) {
            $lowername = strtolower($file);
            if ( $lowername == $localFilename) {
                return $file;
            }
            elseif($lowername == $defaultFilename)
            {
                $defaultReadme = $file;
            }
        }
        
        return $defaultReadme;
    }
    
}