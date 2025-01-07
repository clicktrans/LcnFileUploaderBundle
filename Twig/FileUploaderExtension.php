<?php

namespace Lcn\FileUploaderBundle\Twig;

use Lcn\FileUploaderBundle\Services\FileUploader;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FileUploaderExtension extends AbstractExtension
{

    static $widgetCounter = 0;

    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->fileUploader = $container->get('lcn.file_uploader');
    }

    public function getFunctions()
    {
        return array(
            'lcn_file_uploader_get_temp_files' => new TwigFunction('lcn_file_uploader_get_temp_files', [$this, 'getTempFiles']),
            'lcn_file_uploader_get_unique_widget_id' => new TwigFunction('lcn_file_uploader_get_unique_widget_id', [$this, 'getUniqueWidgetId']),
        );
    }

    public function getTempFiles($uploadFolderName)
    {
        return $this->fileUploader->getTempFiles($uploadFolderName);
    }

    public function getUniqueWidgetId() {
        return 'lcn-file-uploader-'.++static::$widgetCounter;
    }

    public function getName()
    {
        return 'lcn_file_uploader';
    }
}
