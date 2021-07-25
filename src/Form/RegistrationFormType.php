<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,
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
            ->add('username', TextType::class,
                [
                    'label'=>'نام کاربری',
                    'help' => 'لطفا یک نام کاربری برای خود انتخاب کرده و وارد کنید, شما با این نام در سایت شناخته خواهید شد.',
                    'attr'=>
                        [
                            'placeholder' => 'نام کاربری',
                        ],

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
                                            'minMessage' => 'رمزعبور کمتر از 8 کاراکتر است لطفا رمز طولانی تری انتخاب کنید.',
                                            'max'=> 16,
                                            'maxMessage' => 'رمزعبور بیشتر از 16 کاراکتر است لطفا رمز کوتاه تری انتخاب کنید.'
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
                                        'message'=>'لطفا رمزعبور را تکرار کنید'
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
                    ],
                'constraints'=>[new Type([
                    'type'=>'numeric',
                    'message'=>'شماره تلفن نامعتبر است'
                ])]
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
            ->add('terms', CheckboxType::class,
                [
                    'label' => 'لطفا قوانین سایت و شیوه ی خدمات دهی ما را در مطالعه فرمایید',
                    'mapped'=>false,
                    'constraints'=>
                        [
                            new NotBlank([
                                'message'=>'برای عضویت باید با قوانین مواقفت کنید'
                            ])
                        ],
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
