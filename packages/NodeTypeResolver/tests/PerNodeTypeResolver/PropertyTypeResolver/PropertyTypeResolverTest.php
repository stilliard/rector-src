<?php declare(strict_types=1);

namespace Rector\NodeTypeResolver\Tests\PerNodeTypeResolver\PropertyTypeResolver;

use PhpParser\Node\Stmt\Property;
use Rector\NodeTypeResolver\Tests\PerNodeTypeResolver\AbstractNodeTypeResolverTest;
use Rector\NodeTypeResolver\Tests\PerNodeTypeResolver\PropertyTypeResolver\Source\PropertyType;

/**
 * @covers \Rector\NodeTypeResolver\PerNodeTypeResolver\PropertyTypeResolver
 */
final class PropertyTypeResolverTest extends AbstractNodeTypeResolverTest
{
    /**
     * @dataProvider provideTypeForNodesAndFilesData()
     * @param string[] $expectedTypes
     */
    public function test(string $file, int $nodePosition, array $expectedTypes): void
    {
        $propertyNodes = $this->getNodesForFileOfType($file, Property::class);

        $this->assertSame($expectedTypes, $this->nodeTypeResolver->resolve($propertyNodes[$nodePosition]));
    }

    /**
     * @return mixed[][]
     */
    public function provideTypeForNodesAndFilesData(): array
    {
        return [
            # doc block
            [__DIR__ . '/Source/DefinedProperty.php.inc', 0, [PropertyType::class]],
            # constructor defined property
            [__DIR__ . '/Source/DefinedProperty.php.inc', 1, [PropertyType::class]],
            # partial doc block
            [__DIR__ . '/Source/DefinedProperty.php.inc', 2, [PropertyType::class]],
        ];
    }
}
