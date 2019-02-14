<?php

namespace App\Services;


use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName');
//            удаляем имя пользователя
//            ->remove('username');
    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }

    /**
     * Overridden so that username is now optional
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->setUsername($email);
        return parent::setEmail($email);
    }
}