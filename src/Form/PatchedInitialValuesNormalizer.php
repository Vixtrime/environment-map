<?php

namespace App\Form;

use Limenius\Liform\FormUtil;
use Limenius\Liform\Serializer\Normalizer\InitialValuesNormalizer;
use function PHPSTORM_META\type;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormView;

class PatchedInitialValuesNormalizer extends InitialValuesNormalizer
{
    public function normalize($form, $format = null, array $context = [])
    {
        $formView = $form->createView();
//        dump($form->getConfig()->getType()->getOptionsResolver()->resolve());
        return $this->getValues($form, $formView);
    }

    private function getValues(Form $form, FormView $formView)
    {
        if (!empty($formView->children)) {
            if (in_array('choice', FormUtil::typeAncestry($form)) &&
                $formView->vars['expanded']
            ) {
                if ($formView->vars['multiple']) {
                    return $this->normalizeMultipleExpandedChoice($formView);
                } else {
                    return $this->normalizeExpandedChoice($formView);
                }
            }
            // Force serialization as {} instead of []
            $data = (object) array();
            foreach ($formView->children as $name => $child) {
                // Avoid unknown field error when csrf_protection is true
                // CSRF token should be extracted another way
//                dump($name);
//                dump($form);
                if ($form->has($name)) {
                    $data->{$name} = $this->getValues($form->get($name), $child);
                }
            }

            return $data;
        } else {
            // handle separatedly the case with checkboxes, so the result is
            // true/false instead of 1/0
            if (isset($formView->vars['checked'])) {
                return $formView->vars['checked'];
            }

            return $formView->vars['value'];
        }
    }

    private function normalizeMultipleExpandedChoice($formView)
    {
        $data = array();
        foreach ($formView->children as $name => $child) {
            if ($child->vars['checked']) {
                $data[] = $child->vars['value'];
            }
        }
        return $data;
    }

    private function normalizeExpandedChoice($formView)
    {
        foreach ($formView->children as $name => $child) {
            if ($child->vars['checked']) {
                return $child->vars['value'];
            }
        }
        return null;
    }
}
