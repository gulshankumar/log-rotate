<?php /** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUndefinedMethodInspection */

/**
 * This file is part of GulshanDev_LogRotate Module
 *
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\LogRotate\Cron;


use GulshanDev\LogRotate\Model\RotateFactory;

class Rotater
{

    /**
     * @var RotateFactory
     */
    private $rotateFactory;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Rotater constructor.
     * @param RotateFactory $rotateFactory
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(RotateFactory $rotateFactory,
                                \Psr\Log\LoggerInterface $logger)
    {
        $this->rotateFactory = $rotateFactory;
        $this->logger = $logger;
    }

    /**
     *
     */
    public function execute() {

        /** @var \GulshanDev\LogRotate\Model\Rotate $rotateModel */
        $rotateModel = $this->rotateFactory->create();
        try {
            $this->logger->info('Rotating logs Started.');
            $rotateModel->run();
            $this->logger->info('Rotating logs Finished.');
        } catch (\Exception $e) {
            $this->logger->error($e->getTraceAsString());
        }
    }
}