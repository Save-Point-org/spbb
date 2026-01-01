<?php

namespace SavePointOrg\SPBB\Core;

use ErrorException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class ErrorHandlerMiddleware implements MiddlewareInterface
{
    private LoggerInterface $logger;

    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        LoggerFactoryInterface $loggerFactory,
    )
    {
        $this->logger = $loggerFactory
            ->addFile(filename: 'error.log')
            ->createLogger(name: 'errorHandler');
    }

    private function setErrorHandler() : void
    {
        $errorLevels = E_ALL;

        set_error_handler(
            function ($errorNumber, $errorMessage, $errorFile, $errorLine) {
                throw new ErrorException(
                    message: $errorMessage,
                    code: $errorNumber,
                    severity: 1,
                    filename: $errorFile,
                    line: $errorLine,
                );
            },
            $errorLevels
        );
    }

    private function logErrorException(ErrorException $errorException): void
    {
        $code = $errorException->getCode();
        $message = $errorException->getMessage();
        $line = $errorException->getLine();
        $file = $errorException->getFile();
        $errorMessage = sprintf('Error number [%s]: %s on line %s in file %s', $code, $message, $line, $file);

        switch ($code) {
            case E_USER_ERROR:
                $this->logger->error($errorMessage);
                break;
            case E_USER_WARNING:
                $this->logger->warning($errorMessage);
                break;
            default:
                $this->logger->notice($errorMessage);
        }
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $this->setErrorHandler();

            return $handler->handle($request);
        } catch (ErrorException $exception) {
            $this->logErrorException($exception);

            $response = $this->responseFactory->createResponse(code: 500);
            $response->getBody()->write('Internal Server Error');

            return $response;
        }
    }
}