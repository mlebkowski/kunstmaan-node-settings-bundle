<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Helper;

use Doctrine\ORM\EntityManager;
use Kunstmaan\AdminBundle\Helper\FormHelper;
use Kunstmaan\AdminBundle\Helper\FormWidgets\FormWidgetInterface;
use Nassau\KunstmaanNodeSettingsBundle\Entity\CanBeEmptyInterface;
use Nassau\KunstmaanNodeSettingsBundle\Services\NodeSettingsAdaptor;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

class FormWidget implements FormWidgetInterface
{
    use HasIdentifierTrait;

    /**
     * @var NodeSettingsAdaptor
     */
    private $nodeSettingsAdaptor;

    private $types = [];

    /**
     * @param NodeSettingsAdaptor $nodeSettingsAdaptor
     */
    public function __construct(NodeSettingsAdaptor $nodeSettingsAdaptor)
    {
        $this->nodeSettingsAdaptor = $nodeSettingsAdaptor;
    }


    /**
     * @param string       $name
     * @param string|array $builderData
     *
     * @return $this
     */
    public function addType($name, $builderData)
    {
        $this->types[$name] = array_replace([
            'data' => null,
            'options' => [],
        ], is_array($builderData) ? $builderData : ['type' => $builderData]);

        return $this;
    }

    /**
     * Used in the template
     *
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }


    /**
     * @inheritDoc
     */
    public function persist(EntityManager $em)
    {
        foreach ($this->types as $item) {
            $item = $item['data'];

            if (false === ($item instanceof CanBeEmptyInterface && $item->isEmpty())) {
                $em->persist($item);
            } else {
                $em->remove($item);
            }
        }
    }

    /**
     * @param FormBuilderInterface $builder The form builder
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $data = $builder->getData();

        foreach ($this->types as $name => $type) {
            $builder->add($name, $type['type'], $type['options']);
            $data[$name] = $type['data'];
        }

        $builder->setData($data);
    }

    /**
     * @param Request $request
     */
    public function bindRequest(Request $request)
    {
    }

    /**
     * @param FormView $formView
     *
     * @return array
     */
    public function getFormErrors(FormView $formView)
    {
        $formViews = array_intersect_key(iterator_to_array($formView), $this->types);

        return (new FormHelper)->getRecursiveErrorMessages($formViews);
    }


    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'KunstmaanAdminBundle:FormWidgets\FormWidget:widget.html.twig';

    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getExtraParams(Request $request)
    {
        return [];
    }
}
