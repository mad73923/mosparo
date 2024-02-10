<?php

namespace Mosparo\Form;

use Mosparo\Entity\Rule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RuleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $ruleType = $options['rule_type'];
        if ($ruleType === null) {
            return;
        }

        $locale = $options['locale'] ?? null;

        $readonly = $options['readonly'];

        $builder
            ->add('name', TextType::class, ['label' => 'rule.form.rule.name', 'disabled' => $readonly])
            ->add('description', TextareaType::class, ['label' => 'rule.form.rule.description', 'required' => false, 'disabled' => $readonly])
            ->add('status', ChoiceType::class, [
                'label' => 'rule.form.rule.status',
                'choices' => ['state.inactive' => 0, 'state.active' => 1],
                'disabled' => $readonly,
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('spamRatingFactor', NumberType::class, [
                'label' => 'rule.form.rule.spamRatingFactor',
                'required' => false,
                'disabled' => $readonly,
                'help' => 'rule.form.rule.spamRatingFactorHelp',
                'html5' => true,
                'scale' => 1,
                'attr' => [
                    'min' => 0.1,
                    'step' => 'any',
                ]
            ])
            ->add('items', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'entry_type' => $ruleType->getFormClass(),
                'by_reference' => false,
                'entry_options' => [
                    'rule_type' => $ruleType,
                    'locale' => $locale,
                ],
                'disabled' => $readonly,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rule::class,
            'rule_type' => null,
            'locale' => null,
            'readonly' => false,
            'translation_domain' => 'mosparo',
        ]);
    }
}
