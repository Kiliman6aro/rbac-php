<?php
namespace HopHey\Rbac\Tests\Providers;

use HopHey\Rbac\Contracts\Providers\DataProvider;
use HopHey\Rbac\Providers\MemoryDataProvider;
use PHPUnit\Framework\TestCase;

class MemoryDataProviderTest extends TestCase
{
    private DataProvider $dataProvider;
    /**
     * {@inheritDoc}
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    protected function setUp(): void
    {
        $this->dataProvider = new MemoryDataProvider([
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'moderator'],
            ['name' => 'createPost'],
            ['name' => 'updatePost']
        ]);
    }
    
    
    public function testFindByOnceCriteria()
    {
        $expected = [
            ['name' => 'admin']
        ];
        
        $this->assertEquals($expected, $this->dataProvider->findBy(['name' => 'admin']));
    }
    
    public function testFindBySomeCriteria()
    {
        $expected = [
            ['name' => 'admin'],
            ['name' => 'moderator'],
            ['name' => 'createPost']
        ];
        
        $this->assertEquals($expected, $this->dataProvider->findBy(['name' => ['admin', 'moderator', 'createPost']]));
    }
    
    public function testCount()
    {
        $this->assertEquals(1, $this->dataProvider->count(['name' => ['admin']]));
        $this->assertEquals(1, $this->dataProvider->count(['name' => 'manager']));
        $this->assertEquals(2, $this->dataProvider->count(['name' => ['admin','createPost']]));
        $this->assertEquals(3, $this->dataProvider->count(['name' => ['admin', 'moderator', 'createPost', 'deletePost']]));
        $this->assertEquals(5, $this->dataProvider->count());
    }
    
    public function testExists()
    {
        $this->assertTrue($this->dataProvider->exists(['name' => ['admin']]));
        $this->assertFalse($this->dataProvider->exists(['name' => 'root']));
    }
    
    public function testFindByWithEmptyCriteriaAndCatchException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->dataProvider->findBy([]);
    }
    
    
    public function testUpdateByWithEmptyCriteriaAndCatchException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->dataProvider->update([], ['name' => 'test']);
    }
    
    
    public function testDeleteByWithEmptyCriteriaAndCatchException()
    {        
        
        $this->expectException(\InvalidArgumentException::class);
        $this->dataProvider->delete([]);
    }
    
    
    public function testExistsByWithEmptyCriteriaAndCatchExcetion()
    {   
        
        $this->expectException(\InvalidArgumentException::class);
        $this->dataProvider->exists([]);
    }
    
    public function testInsert()
    {
        
        $this->assertEquals(5, $this->dataProvider->count());
        $item = $this->dataProvider->insert(['name' => 'root']);
        $this->assertEquals(6, $this->dataProvider->count());
        $this->assertArrayHasKey('id', $item);
    }
    
    
    public function testUpdate()
    {
        $expected = [
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'moderator'],
            ['name' => 'createPost'],
            ['name' => 'deletePost']
        ];
        
        $this->assertEquals(1, $this->dataProvider->update(['name' => 'updatePost'], ['name' => 'deletePost']));
        $this->assertEquals($expected, $this->dataProvider->all());
    }
    
    
    public function testDelete()
    {
        $expected = [
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'createPost'],
            ['name' => 'updatePost']
        ];
        
        $this->assertEquals(1, $this->dataProvider->delete(['name' => 'moderator']));
        $this->assertEquals($expected, $this->dataProvider->all());
    }
    
    public function testAll()
    {
        $expected = [
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'moderator'],
            ['name' => 'createPost'],
            ['name' => 'updatePost']
        ];
        
        $this->assertEqualsCanonicalizing($expected, $this->dataProvider->all());
    }
    
}

