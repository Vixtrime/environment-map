<?php


namespace App\Services\Dashboard;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationService extends AbstractController
{
    private $serializer;
    private $validator;


    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }


    public function validatePayload($payload, $model, $format)
    {
        $payload = $this->serializer->deserialize($payload, $model, $format);
        $errors = $this->validator->validate($payload);

        if (count($errors)) {
            return $this->createFailureResponse($errors);
        }

        return $payload;
    }


    public function createFailureResponse($content)
    {
        $errorList = null;

        if ($content instanceof ConstraintViolationList) {
            foreach ($content as $error) {
                $errorList[$error->getPropertyPath()] = $error->getMessage();
            }
        }

        return $errorList;
    }
}
