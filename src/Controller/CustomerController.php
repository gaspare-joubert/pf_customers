<?php
declare(strict_types=1);

namespace Podfather\Techtest\Controller;

use Podfather\Techtest\Entity\Customer;
use Podfather\Techtest\Lookup\Customer as CustomerLookup;
use Podfather\Techtest\Storage;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

final class CustomerController extends AbstractController
{
    public function __construct(ContainerInterface $container, private readonly Environment $twig)
    {
        // Psalm complains if this is not set in the constructor
        $this->container = $container;
    }

    #[Route(path: '/', methods: ['GET'])]
    public function list(CustomerLookup $lookup): Response
    {
        $content = $this->twig->render('customer_list.twig', ['customers' => $lookup->get()]);
        return new Response($content);
    }

    #[Route(path: 'customer/new', methods: ['GET'])]
    #[Route(path: 'customer/edit/{id}', methods: ['GET'])]
    public function createOrEditForm(CustomerLookup $lookup, string $id = null): Response
    {
        $customer = $id ? $lookup->getByIdOrFail($id) : new Customer();
        $form = $this->getForm($customer);

        $content = $this->twig->render('customer_form.twig', ['form' => $form->createView()]);
        return new Response($content);
    }

    #[Route(path: 'customer/new', methods: ['POST'])]
    #[Route(path: 'customer/edit/{id}', methods: ['POST'])]
    public function save(Request $request, Storage $storage, string $id = null): Response
    {
        $form = $this->getForm(new Customer($id));
        $form->handleRequest($request);

        /** @var Customer $customer */
        $customer = $form->getData();
        $storage->save($customer);

        return new RedirectResponse('/');
    }

    private function getForm(Customer $customer): FormInterface
    {
        return $this->createFormBuilder($customer)
                    ->add('Name', TextType::class)
                    ->add('Email', EmailType::class)
                    ->add('Address', TextType::class)
                    ->add('City', TextType::class)
                    ->add('Country', TextType::class)
                    ->add('Save', SubmitType::class)
                    ->getForm();
    }
}
