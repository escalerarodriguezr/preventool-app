<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Request;
use Preventool\Infrastructure\Ui\Http\Request\Transformer\RequestBodyTransformer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class RequestArgumentResolver implements ArgumentValueResolverInterface
{
    private ValidatorInterface $validator;
    private RequestBodyTransformer $requestBodyTransformer;

    public function __construct(ValidatorInterface $validator, RequestBodyTransformer $requestBodyTransformer)
    {
        $this->validator = $validator;
        $this->requestBodyTransformer = $requestBodyTransformer;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $reflectionClass = new \ReflectionClass($argument->getType());
        if ($reflectionClass->implementsInterface(RequestDTO::class)) {
            return true;
        }

        return false;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $class = $argument->getType();
        $this->requestBodyTransformer->transform($request);
        $dto = new $class($request);

        $errors = $this->validator->validate($dto);

        if (\count($errors) > 0) {
            $errorCollection = array();
            foreach($errors as $error){
                $errorCollection[$error->getPropertyPath()] = $error->getMessage();
            }

            throw new BadRequestHttpException(json_encode($errorCollection,1));
        }

        yield $dto;
    }
}
