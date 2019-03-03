<?php /** @noinspection PhpUndefinedClassInspection */

/**
 * This file is part of GulshanDev_LogRotate Module
 *
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\LogRotate\Model;

use Psr\Log\LoggerInterface;
use studio24\Rotate\Rotate AS CoreRotate;
use studio24\Rotate\RotateException;

class Rotate extends CoreRotate
{
    /**
     * @var RotateConfig
     */
    private $rotateConfig;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Rotate constructor.
     * @param RotateConfig $rotateConfig
     * @param LoggerInterface $logger
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(RotateConfig $rotateConfig, LoggerInterface $logger)
    {
        $this->rotateConfig = $rotateConfig;
        parent::__construct($this->rotateConfig->getFilenameFormatWithPath());
        $this->keep($this->rotateConfig->getKeepNumberOfFiles());
        try {
            $this->size($this->rotateConfig->getMinSizeToRotate());
        } catch (RotateException $e) {
        }
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if($this->rotateConfig->isActive()) {
            return parent::run();
        }
        return [];
    }
}