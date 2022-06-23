<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Custom\MenuLink\Plugin;

use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\UrlInterface;

class Topmenu {
    /**
     * @var NodeFactory
     */
    protected $nodeFactory;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param NodeFactory  $nodeFactory
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        NodeFactory $nodeFactory,
        UrlInterface $urlBuilder
    ) {
        $this->nodeFactory = $nodeFactory;
        $this->urlBuilder = $urlBuilder;
    }

    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {
        /**
         * Parent Menu
         */
        $menuNode = $this->nodeFactory->create(
            [
                'data' => $this->getNodeAsArray("Terms & Condition", "termscondition"),
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree(),
            ]
        );
        /**
         * Add Child Menu
         */
        /*$menuNode->addChild(
            $this->nodeFactory->create(
                [
                    'data' => $this->getNodeAsArray("Sub Menu", "sub-menu"),
                    'idField' => 'id',
                    'tree' => $subject->getMenu()->getTree(),
                ]
            )
        );
         */
        $subject->getMenu()->addChild($menuNode);
    }

    protected function getNodeAsArray($name, $id) {
        $url = $this->urlBuilder->getUrl($id);
        return [
            'name' => __($name),
            'id' => $id,
            'url' => $url,
            'has_active' => false,
            'is_active' => false,
        ];
    }
}
