<?php
declare(strict_types=1);

namespace Ranky\MediaBundle\Tests\Presentation\Twig;


use Ranky\MediaBundle\Infrastructure\Filesystem\Flysystem\FlysystemFileUrlResolver;
use Ranky\MediaBundle\Presentation\Twig\MediaTwigExtension;
use Ranky\SharedBundle\Domain\Site\SiteUrlResolverInterface;
use Twig\Test\IntegrationTestCase;

class MediaTwigExtensionIntegrationTest extends IntegrationTestCase
{

    protected function getExtensions(): array
    {
        $uploadUrl           = $_ENV['SITE_URL'].'/uploads';
        $mockSiteUrlResolver = $this->getMockBuilder(SiteUrlResolverInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockSiteUrlResolver
            ->method('siteUrl')
            ->willReturn($_ENV['SITE_URL']);

        $fileUrlResolver = new FlysystemFileUrlResolver(
            $uploadUrl,
            'local',
            $mockSiteUrlResolver
        );

        return [
            new MediaTwigExtension($fileUrlResolver),
        ];
    }

    protected function getFixturesDir(): string
    {
        return __DIR__.'/Fixtures/';
    }
}
