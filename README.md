# ImageOptimizer

This is PHP library for Image Optimizer https://imageoptim.com/api/post
 
## Usage

```PHP

$image_optimizer = new \Icewild\ImageOptimizer\ImageOptimizer('YOUR_USERNAME');


$image_optimizer->setWidthAndHeight(100, 100);
$image_optimizer->setResizeStrategy(new ResizeStrategy('crop'));
$image_optimizer->setSourceUrl('https://avatars3.githubusercontent.com/u/8243173');

$result = $image_optimizer->getImage();

file_put_contents('/your/place/to/save/image.ext', $result);

```

## ToDo

Add validation to set parameters to avoid receiving 400 Bad Options by ImageOptim Server
