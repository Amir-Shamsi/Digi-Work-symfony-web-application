<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class TicketFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productModel', null,
                [
                    'label'=>'برند*',
                    'help' => 'لطفا برند محصول را وارد کنید',
                    'attr'=>
                        [
                            'placeholder' => 'شرکت سازنده',
                        ]

                ])
            ->add('productBrand', null,
                [
                'label'=>'مدل*',
                        'help' => 'لطفا مدل محصول را وارد کنید',
                        'attr'=>
                            [
                                'placeholder' => 'مدل',
                            ]

                    ])
            ->add('problemSubject', null,
                [
                    'label'=>'نوع مشکل*',
                    'help' => 'لطفا نوع مشکل که دستگاه دچار شده را انتخاب کنید',
                    'attr'=>
                        [
                            'placeholder' => 'نوع مشکل',
                        ]

                ])
            ->add('details', null,
                [
                    'label'=>'توضیحات تکمیلی',
                    'help' => 'لطفا توضیحات تکمیلی را وارد کنید',
                    'attr'=>
                        [
                            'placeholder' => 'توضیحات تکمیلی',
                        ]

                ])
            ->add('imageFile', FileType::class,
                [
                    'label'=>' ',
                    'mapped'=>false,
                    'required' => false,
                    'help'=>'محل اضافه کردن عکس دستگاه',
                    'attr'=>
                        [
                            'placeholder' => ' ... .. .. ....    فرمت قابل قبول تصویر jpg, png و ...',

                        ],
                    'constraints' => [
//                        new File([
//                            'maxSize' => '5120k', //5MB
//                            'mimeTypes' => [
//                                'application/pdf',
//                                'application/x-pdf',
//                            ],
//                            'mimeTypesMessage' => 'لطفا یک عکس با فرمت های خواسته شده آپلود کنید',
//                        ])
                    ],
                ]);
//            ->add('reservedDate',  DateType::class,[
//                'label'=>'تاریخ درخواستی',
//                'help' => 'لطفا تاریخ درخواستی را انتخاب کنید',
//                'widget'=>'single_text',
//                'days' => range(19,31),
//                'years'=> range(2021, 2099),
//                'attr'=>
//                    [
//                        'placeholder' => 'توضیحات تکمیلی',
//                    ]
//
//            ]);

        // user form
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
