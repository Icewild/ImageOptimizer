<?php

namespace Icewild\ImageOptimizer\Tests;

use Icewild\ImageOptimizer\ImageOptimizer;
use Icewild\ImageOptimizer\Value\Color;
use Icewild\ImageOptimizer\Value\Dpi;
use Icewild\ImageOptimizer\Value\Format;
use Icewild\ImageOptimizer\Value\Quality;
use Icewild\ImageOptimizer\Value\ResizeStrategy;
use phpmock\phpunit\PHPMock;

/**
 * @codeCoverageIgnore
 */
class ImageOptimizerTest extends \PHPUnit_Framework_TestCase
{
    use PHPMock;

    /** @var \Icewild\ImageOptimizer\ImageOptimizer */
    protected $image_optimizer;

    public function setUp()
    {
        $this->image_optimizer = new ImageOptimizer('SOME_USERNAME');
    }

    public function testImageOptimizer()
    {
        $file_get_contents = $this->getFunctionMock('Icewild\\ImageOptimizer', 'file_get_contents');

        $file_get_contents
            ->expects($this->once())
            ->willReturn('some very long string with Image DATA');

        $this->image_optimizer->setWidthAndHeight(100, 100);
        $this->image_optimizer->setResizeStrategy(new ResizeStrategy('crop'));
        $this->image_optimizer->setSourceUrl('https://avatars3.githubusercontent.com/u/8243173');

        $this->image_optimizer->getImage();
    }

    public function testImageOptimizer_2()
    {
        $this->image_optimizer->setWidthAndHeight(100);
        $this->image_optimizer->setResizeStrategy(new ResizeStrategy('fit'));
        $this->image_optimizer->setSourceUrl('https://avatars3.githubusercontent.com/u/8243173');
        $this->image_optimizer->setTimeout(5);
        $this->image_optimizer->setQuality(new Quality(Quality::LOSSLESS_QUALITY));
        $this->image_optimizer->setDpi(new Dpi(2));
        $this->image_optimizer->setBgColor(new Color('fff'));
        $this->image_optimizer->setFormat(new Format(Format::PNG_FORMAT));

        $this->image_optimizer->getImage();
    }

    public function testValueColor()
    {
        $color = new Color('ffaabb');

        $this->assertEquals('ffaabb', $color->getValue());
    }


    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^String \[(.+?)\] is not a hex color$/
     */
    public function testValueColor_2()
    {
        new Color('ffaabbdd');
    }

    public function testValueDpi()
    {
        $dpi = new Dpi(2);

        $this->assertEquals(2, $dpi->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^DPI \[(.+?)\] not available$/
     */
    public function testValueDpi_2()
    {
        new Dpi(15);
    }

    public function testValueFormat()
    {
        $format = new Format('jpeg');

        $this->assertEquals('jpeg', $format->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^Format \[(.+?)\] not available$/
     */
    public function testValueFormat_2()
    {
        new Format('not-existant-format');
    }

    public function testValueQuality()
    {
        $quality = new Quality('medium');

        $this->assertEquals('medium', $quality->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^Quality \[(.+?)\] is not available$/
     */
    public function testValueQuality_2()
    {
        new Quality('not_quality');
    }

    public function testValueResizeStrategy()
    {
        $resize_strategy = new ResizeStrategy('crop');

        $this->assertEquals('crop', $resize_strategy->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^Strategy \[(.+?)\] is not available$/
     */
    public function testValueResizeStrategy_2()
    {
        new ResizeStrategy('not_existance');
    }
}
