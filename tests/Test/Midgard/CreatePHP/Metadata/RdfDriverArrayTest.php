<?php

namespace Test\Midgard\CreatePHP\Metadata;

use Midgard\CreatePHP\RdfMapperInterface;
use Midgard\CreatePHP\Metadata\RdfDriverArray;

class RdfDriverArrayTest extends RdfDriverBase
{
    /**
     * @var \Midgard\CreatePHP\Metadata\RdfDriverInterface
     */
    private $driver;

    public function setUp()
    {
        $def = array(
            "Test\\Midgard\\CreatePHP\\Model" => array (
               "vocabularies" => array(
                   "xmlns:sioc" => "http://rdfs.org/sioc/ns#",
                   "xmlns:dcterms" => "http://purl.org/dc/terms/",
               ),
               "typeof" => "sioc:Post",
               "config" => array(
                   "key" => "value",
               ),
               "children" => array(
                   "title" => array(
                       "type" => "property",
                       "property" => "dcterms:title",
                       "tag-name" => "h2",
                   ),
                   "tags" => array(
                       "type" => "collection",
                       "rel" => "skos:related",
                       "tag-name" => "ul",
                       "config" => array(
                           "key" => "value",
                       ),
                   ),
                   "property" => array(
                       "type" => "property",
                       "property" => "sioc:content",
                   ),
               ),
            ),
            );
        $this->driver = new RdfDriverArray($def);
    }

    public function testLoadTypeForClass()
    {
        $mapper = $this->getMock('Midgard\\CreatePHP\\RdfMapperInterface');
        $type = $this->driver->loadTypeForClass('Test\\Midgard\\CreatePHP\\Model', $mapper);

        $this->assertTestNodetype($type);
    }

    public function testLoadTypeForClassNodefinition()
    {
        $mapper = $this->getMock('Midgard\\CreatePHP\\RdfMapperInterface');
        $type = $this->driver->loadTypeForClass('Midgard\\CreatePHP\\Not\\Existing\\Class', $mapper);
        $this->assertNull($type);
    }

    /**
     * Gets the names of all classes known to this driver.
     *
     * @return array The names of all classes known to this driver.
     */
    function testGetAllClassNames()
    {
        // TODO
    }
}
