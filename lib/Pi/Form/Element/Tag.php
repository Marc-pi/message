<?php
/**
 * Pi Engine (http://pialog.org)
 *
 * @link            http://code.pialog.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://pialog.org
 * @license         http://pialog.org/license.txt New BSD License
 * @package         Form
 */

namespace Pi\Form\Element;

/**
 * Tag input element
 *
 * Create a blank tag input element
 *
 * ```
 *  $form->add(
 *      'type'      => 'tag',
 *      'name'      => <element-name>,
 *  );

 *  $form->add(
 *      'type'      => 'tag',
 *      'name'      => <element-name>,
 *      'options'   => array(
 *          'label' => __('Tags'),
 *      ),
 *  );
 * ```
 *
 * Create tag edit element
 *
 * ```
 *  $form->add(
 *      'type'      => 'tag',
 *      'name'      => <element-name>,
 *      'options'   => array(
 *          'module'    => <module>,
 *          'item'      => <item-id>,
 *          'type'      => <type>,
 *      ),
 *  );
 * ```
 *
 * @author Taiwen Jiang <taiwenjiang@tsinghua.org.cn>
 */
class Tag extends Textarea
{
    /**
     * {@inheritDoc}
     */
    protected $attributes = array(
        'type'  => 'textarea',
        'rows'  => 2,
    );

    /**
     * Retrieve the element value. Retrieve from tag database if not specified
     *
     * {@inheritDoc}
     */
    public function getValue()
    {
        if (null === $this->value) {
            $module = $this->getOption('module');
            $type = $this->getOption('type');
            $item = $this->getOption('item');
            if ($module && $item) {
                $tags = Pi::service('tag')->get($module, $item, $type);
                $this->value = implode(' ', $tags);
            }
        }

        return parent::getValue();
    }

    /**
     * {@inheritDoc}
     */
    public function getLabel()
    {
        if (null === $this->label) {
            $this->label = __('Tags');
        }

        return parent::getLabel();
    }
}
