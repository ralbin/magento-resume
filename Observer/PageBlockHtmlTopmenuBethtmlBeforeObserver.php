<?php
/**
 * I found this logic in another module, and absolutely loved how this worked.
 * It is rather similar to a technique I used in Magento 1.x
 *
 */
namespace RussellAlbin\Resume\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Data\Tree\Node;

/**
 * Resume observer for the html top menu
 */
class PageBlockHtmlTopmenuBethtmlBeforeObserver implements ObserverInterface
{
    /**
     * Show top menu item config path
     */
    const XML_PATH_TOP_MENU_SHOW_ITEM = 'russellalbin/top_menu/show_item';

    /**
     * Top menu item text config path
     */
    const XML_PATH_TOP_MENU_ITEM_TEXT_DB = 'russellalbin/top_menu/item_text_db';
    const XML_PATH_TOP_MENU_ITEM_TEXT_XML = 'russellalbin/top_menu/item_text_xml';

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_url;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @param \Magento\Framework\UrlInterface $url
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_url = $url;
    }

    /**
     * Page block html topmenu gethtml before
     * We are going to inject our menu if the setting is configured to be used for the store view
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->_scopeConfig->isSetFlag(static::XML_PATH_TOP_MENU_SHOW_ITEM, \Magento\Store\Model\ScopeInterface::SCOPE_STORE)) {
            return;
        }

        /** @var \Magento\Framework\Data\Tree\Node $menu */
        $menu = $observer->getMenu();
        $block = $observer->getBlock();

        $tree = $menu->getTree();
        $data = [
            'name'      => $this->_scopeConfig->getValue(static::XML_PATH_TOP_MENU_ITEM_TEXT_DB, \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'id'        => 'russellalbin-resume-db',
            'url'       => $this->_url->getUrl('resume/db'),
            'is_active' => ($block->getRequest()->getModuleName() == 'resume'),
        ];
        $node = new Node($data, 'id', $tree, $menu);
        $menu->addChild($node);

        $data = [
            'name'      => $this->_scopeConfig->getValue(static::XML_PATH_TOP_MENU_ITEM_TEXT_XML, \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'id'        => 'russellalbin-resume-xml',
            'url'       => $this->_url->getUrl('resume/xml'),
            'is_active' => ($block->getRequest()->getModuleName() == 'resume'),
        ];
        $node = new Node($data, 'id', $tree, $menu);
        $menu->addChild($node);

    }
}
