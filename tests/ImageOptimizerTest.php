<?php

namespace Icewild\ImageOptimizer\Tests;

use Icewild\ImageOptimizer\ImageOptimizer;
use Icewild\ImageOptimizer\Value\Color;
use Icewild\ImageOptimizer\Value\Dpi;
use Icewild\ImageOptimizer\Value\Format;
use Icewild\ImageOptimizer\Value\Quality;
use Icewild\ImageOptimizer\Value\ResizeStrategy;
use Icewild\ImageOptimizer\Value\Timeout;
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

        $image = $this->image_optimizer->createFromUrl('https://avatars3.githubusercontent.com/u/8243173');

        $image->setWidthAndHeight(100, 100);
        $image->setResizeStrategy(new ResizeStrategy('crop'));
        $image->getBytes();
    }

    public function testImageOptimizer_2()
    {
        $file_get_contents = $this->getFunctionMock('Icewild\\ImageOptimizer', 'file_get_contents');

        $file_get_contents
            ->expects($this->once())
            ->willReturn('some very long string with Image DATA');

        $image = $this->image_optimizer->createFromUrl('https://avatars3.githubusercontent.com/u/8243173');

        $image->setWidthAndHeight(100);
        $image->setResizeStrategy(new ResizeStrategy('fit'));
        $image->setTimeout(new Timeout(5));
        $image->setQuality(new Quality(Quality::LOSSLESS_QUALITY));
        $image->setDpi(new Dpi(2));
        $image->setBgColor(new Color('fff'));
        $image->setFormat(new Format(Format::PNG_FORMAT));

        $image->getBytes();
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
     * @expectedExceptionMessageRegExp /^Available DPI are \[(.+?)\]. Got \[(.+?)\].$/
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
     * @expectedExceptionMessageRegExp /^Available formats are \[(.+?)\]. Got \[(.+?)\].$/
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
     * @expectedExceptionMessageRegExp /^Available qualities are \[(.+?)\]. Got \[(.+?)\].$/
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

    public function testValueTimeout()
    {
        $timeout = new Timeout(5);

        $this->assertEquals(5, $timeout->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^Timeout is not a positive number. Got \[(.+?)\].$/
     */
    public function testValueTimeout_2()
    {
        new Timeout('not_existance');
    }
}
