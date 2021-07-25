<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', \Symfony\Component\Form\Extension\Core\Type\TextType::class,
            [
                'label'=>'نام',
                'help' => 'لطفا نام خود را وارد کنید',
                'attr'=>
                    [
                        'placeholder' => 'نام',
                    ]

            ])
            ->add('lastName', null,
                [
                    'label'=>'نام خانوادگی',
                    'help' => 'لطفا نام خانوادگی خود را وارد کنید',
                    'attr'=>
                        [
                            'placeholder' => 'نام خانوادگی',
                        ]

                ])
            ->add('username', null,
                [
                    'label'=>'نام کاربری',
                    'help' => 'لطفا یک نام کاربری برای خود انتخاب کرده و وارد کنید, شما با این نام در سایت شناخته خواهید شد.',
                    'attr'=>
                        [
                            'placeholder' => 'نام کاربری',
                        ]

                ])
            ->add('planePassword', RepeatedType::class,
                [
                    'mapped'=>false,
                    'type' => PasswordType::class,
                    'invalid_message' => 'دو پسورد برابر نمی باشند',
                    'first_options'  =>
                        [
                            'label' => 'رمزعبور',
                            'help' => 'لطفا یک رمزعبور بین 8 تا 16 کاراکتر برای نام کاربری خود انتخاب کنید.',
                            'attr'=>
                                [
                                    'placeholder' => 'رمزعبور',
                                ],
                            'constraints'=>
                                [
                                    new NotBlank([
                                        'message'=>'لطفا رمزعبور را وارد کنید'
                                    ]),
                                    new Length(
                                        [
                                            'min'=> 8,
                                            'minMessage' => 'رمزعبور کتر از 8 کاراکتر است لطفا رمز طولانی تری انتخاب کنید.',
                                            'max'=> 20,
                                            'maxMessage' => 'Password is bigger than what i expected 😕'
                                        ]
                                    )
                                ],
                        ],
                    'second_options' =>
                        [
                            'help' => 'بخش رمزعبور حساس است هر دو قسمت رمزعبور را صحیح وارد کنید.',
                            'label' => 'تکرار رمزعبور',
                            'constraints'=>
                                [
                                    new NotBlank([
                                        'message'=>'Enter again to make sure you want this password🔑'
                                    ])
                                ],
                            'attr'=>
                                [
                                    'placeholder' => 'تکرار رمزعبور',
                                ],

                        ]

                ])
            ->add('phone', null,
            [
                'label'=>'شماره تماس',
                'help' => 'لطفا شماره تماس خود را وارد کنید',
                'attr'=>
                    [
                        'placeholder' => 'شماره تماس',
                    ]
            ])
            ->add('email', null,
                [
                    'label'=>'ایمیل',
                    'help' => 'در صورت تمایل ایمیل خود را وارد کنید.',
                    'attr'=>
                        [
                            'placeholder' => 'ایمیل',
                        ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
