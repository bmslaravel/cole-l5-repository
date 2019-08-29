<?php
namespace Prettus\Repository\Generators;

/**
 * Class ControllerGenerator
 * @package Prettus\Repository\Generators
 */
class RouteGenerator extends Generator
{

    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'route/route';

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return '';
    }

    /**
     * Get generator path config node.
     *
     * @return string
     */
    public function getPathConfigNode()
    {
        return '';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/' . $this->getSingularName() . '.php';
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return base_path('routes/web');
    }

    /**
     * Gets controller name based on model
     *
     * @return string
     */
    public function getControllerName()
    {

        return ucfirst($this->getPluralName());
    }

    /**
     * Gets plural name based on model
     *
     * @return string
     */
    public function getPluralName()
    {

        return str_plural(lcfirst(ucwords($this->getClass())));
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {

        return array_merge(parent::getReplacements(), [
            'mkdir'      => $this->getSingularName(),
            'classs'     => ucfirst($this->getPluralName()),
        ]);
    }

    /**
     * Gets singular name based on model
     *
     * @return string
     */
    public function getSingularName()
    {
        return str_singular(lcfirst(ucwords($this->getClass())));
    }

    /**
     * Gets validator full class name
     *
     * @return string
     */
    public function getValidator()
    {
        $validatorGenerator = new ValidatorGenerator([
            'name' => $this->name,
        ]);

        $validator = $validatorGenerator->getRootNamespace() . '\\' . $validatorGenerator->getName();

        return 'use ' . str_replace([
            "\\",
            '/'
        ], '\\', $validator) . 'Validator;';
    }


    /**
     * Gets repository full class name
     *
     * @return string
     */
    public function getRepository()
    {
        $repositoryGenerator = new RepositoryInterfaceGenerator([
            'name' => $this->name,
        ]);

        $repository = $repositoryGenerator->getRootNamespace() . '\\' . $repositoryGenerator->getName();

        return 'use ' . str_replace([
            "\\",
            '/'
        ], '\\', $repository) . 'Repository;';
    }

    /**
     * Gets repository full class name
     *
     * @return string
     */
    public function getRepositoryEloquent()
    {
        $repositoryGenerator = new RepositoryEloquentGenerator([
            'name' => $this->name,
        ]);

        $repository = $repositoryGenerator->getRootNamespace() . '\\' . $repositoryGenerator->getName();

        return 'use ' . str_replace([
                "\\",
                '/'
            ], '\\', $repository) . 'RepositoryEloquent;';
    }
}
