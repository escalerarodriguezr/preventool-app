<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Listener\Shared;

use Preventool\Domain\Company\Model\Exception\CompanyAlreadyExistsException;
use Preventool\Domain\Company\Model\Exception\CompanyNotFoundException;
use Preventool\Domain\Organization\Model\Exception\OrganizationAlreadyExistsException;
use Preventool\Domain\Organization\Model\Exception\OrganizationNotFoundException;
use Preventool\Domain\User\Model\Exception\ActionUserAccessDeniedException;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;
use Preventool\Domain\User\Model\Exception\UserAccountNotActiveException;
use Preventool\Domain\User\Model\Exception\UserAlreadyExistsException;
use Preventool\Domain\User\Model\Exception\UserNotFoundException;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

class JsonTransformerExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        $data = [
            'class' => \get_class($exception),
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $exception->getMessage(),
        ];

        if (\in_array($data['class'], $this->getNotFoundExceptions(), true)) {
            $data['code'] = Response::HTTP_NOT_FOUND;
        }

        if (\in_array($data['class'], $this->getDeniedExceptions(), true)) {
            $data['code'] = Response::HTTP_FORBIDDEN;
        }

        if (\in_array($data['class'], $this->getConflictExceptions(), true)) {
            $data['code'] = Response::HTTP_CONFLICT;
        }

        if ($exception instanceof HttpExceptionInterface) {
            $data['code'] = $exception->getStatusCode();
        }

        $event->setResponse($this->prepareResponse($data));

    }


    private function prepareResponse(array $data): JsonResponse
    {
        $response = new JsonResponse($data, $data['code']);
        $response->headers->set('X-Error-Code', $data['code']);
        $response->headers->set('X-Server-Time', \time());

        return $response;
    }

    private function getNotFoundExceptions(): array
    {
        return [
            UserNotFoundException::class,
            OrganizationNotFoundException::class
        ];
    }

    private function getConflictExceptions(): array
    {
        return [
            UserAlreadyExistsException::class,
            UserAccountNotActiveException::class,
            ActionUserActionNotAllowedException::class,
            CompanyAlreadyExistsException::class,
            CompanyNotFoundException::class,
            OrganizationAlreadyExistsException::class
        ];
    }

    private function getDeniedExceptions(): array
    {
        return [
            AccessDeniedException::class,
            ActionUserAccessDeniedException::class
        ];
    }

}