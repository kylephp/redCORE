<?php
/**
 * @package     RedRad
 * @subpackage  Menu
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_REDRAD') or die;

/**
 * Represents a menu node (link).
 *
 * @package     RedRad
 * @subpackage  Menu
 * @since       1.0
 */
class RMenuNode
{
	/**
	 * The node name.
	 *
	 * @var  string
	 */
	protected $name;

	/**
	 * A flag to check if the link is active.
	 *
	 * @var  boolean
	 */
	protected $active = false;

	/**
	 * The parent node.
	 *
	 * @var  RMenuNode
	 */
	protected $parent;

	/**
	 * The children nodes.
	 *
	 * @var  RMenuNode[]
	 */
	protected $children = array();

	/**
	 * Constructor.
	 *
	 * @param  string  $name  The link name.
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}

	/**
	 * Get the node name.
	 *
	 * @return  string  The node name.
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the parent node.
	 *
	 * @param   RMenuNode  $parent  The parent node.
	 *
	 * @return  RMenuNode  This method is chainable.
	 */
	public function setParent(RMenuNode $parent)
	{
		$this->parent = $parent;

		return $this;
	}

	/**
	 * Get the parent node.
	 *
	 * @return  RMenuNode
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * Add a child to this node.
	 *
	 * @param   RMenuNode  $child  The child.
	 *
	 * @return  RMenuNode  This method is chainable.
	 */
	public function addChild(RMenuNode $child)
	{
		// Add the children.
		$this->children[$child->getName()] = $child;

		// Set this node as parent.
		$child->setParent($this);

		return $this;
	}

	/**
	 * Checks if the given node is a child of this node.
	 *
	 * @param   string|RMenuNode  $node  The node.
	 *
	 * @return  boolean  True if child, false otherwise.
	 */
	public function hasChild($node)
	{
		if ($node instanceof RMenuNode)
		{
			$node = $node->getName();
		}

		return isset($this->children[$node]);
	}

	/**
	 * Get the children of this node.
	 *
	 * @return  RMenuNode  An array of nodes.
	 */
	public function getChildren()
	{
		return $this->children;
	}

	/**
	 * Get the active child if any.
	 *
	 * @return  RMenuNode|false  The active child or false if no active hild.
	 */
	public function getActiveChild()
	{
		foreach ($this->children as $child)
		{
			if ($child->isActive())
			{
				return $child;
			}

			if ($active = $child->getActiveChild())
			{
				return $active;
			}
		}

		return false;
	}

	/**
	 * Set the menu link active.
	 * The parent is also set active recursively.
	 *
	 * @return  RMenuNode  This method is chainable.
	 */
	public function setActive()
	{
		$this->active = true;

		return $this;
	}

	/**
	 * Check if the node is active.
	 *
	 * @return  boolean  True if active, false otherwise.
	 */
	public function isActive()
	{
		return $this->active;
	}
}
