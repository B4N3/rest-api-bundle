<?php

namespace Tests;

use Tests;
use RestApiBundle;
use Nyholm\BundleTest\BaseBundleTestCase;

class ExceptionTranslationsTest extends BaseBundleTestCase
{
    /**
     * @var RestApiBundle\Manager\RequestModelManager
     */
    private $requestModelManager;

    protected function getBundleClass()
    {
        return RestApiBundle\RestApiBundle::class;
    }

    public function __construct()
    {
        parent::__construct();

        $this->bootKernel();
        $container = $this->getContainer();
        $this->requestModelManager = $container->get(RestApiBundle\Manager\RequestModelManager::class);
    }

    public function testBooleanRequiredException()
    {
        try {
            $model = new Tests\Demo\RequestModel\ModelWithAllTypes();
            $this->requestModelManager->handleRequest($model, [
                'booleanType' => 'string',
            ]);
            $this->fail();
        } catch (RestApiBundle\Exception\RequestModelMappingException $exception) {
            $this->assertSame(['booleanType' => ['This value should be boolean.']], $exception->getProperties());
        }
    }

    public function testStringRequiredException()
    {
        try {
            $model = new Tests\Demo\RequestModel\ModelWithAllTypes();
            $this->requestModelManager->handleRequest($model, [
                'stringType' => false,
            ]);
            $this->fail();
        } catch (RestApiBundle\Exception\RequestModelMappingException $exception) {
            $this->assertSame(['stringType' => ['This value should be string.']], $exception->getProperties());
        }
    }

    public function testIntegerRequiredException()
    {
        try {
            $model = new Tests\Demo\RequestModel\ModelWithAllTypes();
            $this->requestModelManager->handleRequest($model, [
                'integerType' => false,
            ]);
            $this->fail();
        } catch (RestApiBundle\Exception\RequestModelMappingException $exception) {
            $this->assertSame(['integerType' => ['This value should be integer.']], $exception->getProperties());
        }
    }

    public function testFloatRequiredException()
    {
        try {
            $model = new Tests\Demo\RequestModel\ModelWithAllTypes();
            $this->requestModelManager->handleRequest($model, [
                'floatType' => false,
            ]);
            $this->fail();
        } catch (RestApiBundle\Exception\RequestModelMappingException $exception) {
            $this->assertSame(['floatType' => ['This value should be float.']], $exception->getProperties());
        }
    }

    public function testModelRequiredException()
    {
        try {
            $model = new Tests\Demo\RequestModel\ModelWithAllTypes();
            $this->requestModelManager->handleRequest($model, [
                'model' => false,
            ]);
            $this->fail();
        } catch (RestApiBundle\Exception\RequestModelMappingException $exception) {
            $this->assertSame(['model' => ['This value should be object.']], $exception->getProperties());
        }
    }

    public function testCollectionRequiredException()
    {
        try {
            $model = new Tests\Demo\RequestModel\ModelWithAllTypes();
            $this->requestModelManager->handleRequest($model, [
                'collection' => false,
            ]);
            $this->fail();
        } catch (RestApiBundle\Exception\RequestModelMappingException $exception) {
            $this->assertSame(['collection' => ['This value should be collection.']], $exception->getProperties());
        }
    }

    public function testInvalidDateFormatException()
    {
        try {
            $model = new Tests\Demo\RequestModel\ModelWithAllTypes();
            $this->requestModelManager->handleRequest($model, [
                'date' => false,
            ]);
            $this->fail();
        } catch (RestApiBundle\Exception\RequestModelMappingException $exception) {
            $this->assertSame(['date' => ['This value should be valid date with format "Y-m-d".']], $exception->getProperties());
        }
    }

    public function testInvalidDateTimeFormatException()
    {
        try {
            $model = new Tests\Demo\RequestModel\ModelWithAllTypes();
            $this->requestModelManager->handleRequest($model, [
                'dateTime' => false,
            ]);
            $this->fail();
        } catch (RestApiBundle\Exception\RequestModelMappingException $exception) {
            $this->assertSame(['dateTime' => ['This value should be valid date time with format "Y-m-d\TH:i:sP".']], $exception->getProperties());
        }
    }

    public function testUndefinedKeyException()
    {
        try {
            $model = new Tests\Demo\RequestModel\ModelWithAllTypes();
            $this->requestModelManager->handleRequest($model, [
                'undefinedKey' => false,
            ]);
            $this->fail();
        } catch (RestApiBundle\Exception\RequestModelMappingException $exception) {
            $this->assertSame(['undefinedKey' => ['Key is not defined in model.']], $exception->getProperties());
        }
    }
}