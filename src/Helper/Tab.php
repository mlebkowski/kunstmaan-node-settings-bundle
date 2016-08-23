<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Helper;

use Doctrine\ORM\EntityManager;
use Kunstmaan\AdminBundle\Helper\FormWidgets\FormWidgetInterface;
use Kunstmaan\AdminBundle\Helper\FormWidgets\Tabs\TabInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

class Tab implements TabInterface
{
    use HasIdentifierTrait;

    /**
     * @var string
     */
    private $title;

    /**
     * @var FormWidgetInterface
     */
    private $formWidget;

    /**
     * @param string              $title
     * @param FormWidgetInterface $formWidget
     */
    public function __construct($title, FormWidgetInterface $formWidget)
    {
        $this->title = $title;
        $this->formWidget = $formWidget;
    }

    /**
     * @param FormBuilderInterface $builder The form builder
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $this->formWidget->buildForm($builder);
    }

    /**
     * @param Request $request
     */
    public function bindRequest(Request $request)
    {
        $this->formWidget->bindRequest($request);
    }

    /**
     * @param EntityManager $em The entity manager
     */
    public function persist(EntityManager $em)
    {
        $this->formWidget->persist($em);
    }

    /**
     * @param FormView $formView
     *
     * @return array
     */
    public function getFormErrors(FormView $formView)
    {
        return $this->formWidget->getFormErrors($formView);
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'KunstmaanAdminBundle:Tabs:tab.html.twig';
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getExtraParams(Request $request)
    {
        return $this->formWidget->getExtraParams($request);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function getWidget()
    {
        return $this->formWidget;
    }
}
