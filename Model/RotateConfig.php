<?php
/**
 * This file is part of GulshanDev_LogRotate Module
 *
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\LogRotate\Model;


use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class RotateConfig
{
    const ACTIVE_CONFIG_PATH = 'system/log_rotate/active';
    const SIZE_CONFIG_PATH = 'system/log_rotate/keep_size';
    const KEEP_NUMBER_CONFIG_PATH = 'system/log_rotate/keep_number';
    /**
     * @var DirectoryList
     */
    private $directoryList;
    /**
     * @var string
     */
    private $fileNamePattern;
    /**
     * @var string
     */
    private $dirName;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * RotateConfig constructor.
     * @param DirectoryList $directoryList
     * @param ScopeConfigInterface $scopeConfig
     * @param string $dirName
     * @param string $fileNamePattern
     */
    public function __construct(DirectoryList $directoryList,
                                ScopeConfigInterface $scopeConfig,
                                $dirName = DirectoryList::LOG,
                                $fileNamePattern = '*.log')
    {
        $this->directoryList = $directoryList;
        $this->fileNamePattern = $fileNamePattern;
        $this->dirName = $dirName;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function getDirectoryPath() {
        return $this->directoryList->getPath($this->dirName);
    }

    /**
     * @return string
     */
    public function getFilenameFormat() {
        return $this->fileNamePattern;
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function getFilenameFormatWithPath(){
        return $this->getDirectoryPath(). DIRECTORY_SEPARATOR . $this->getFilenameFormat();
    }

    /**
     * @return mixed
     */
    public function getMinSizeToRotate() {
        $value = (int) $this->scopeConfig->getValue(self::SIZE_CONFIG_PATH);
        return $value ? $value.'MB' : '5MB';
    }

    /**
     * @return mixed
     */
    public function getKeepNumberOfFiles() {
        return $this->scopeConfig->getValue(self::KEEP_NUMBER_CONFIG_PATH);
    }

    /**
     * @return mixed
     */
    public function isActive() {
        return $this->scopeConfig->getValue(self::ACTIVE_CONFIG_PATH);
    }
}