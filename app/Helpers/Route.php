<?php


namespace App\Helpers;


class Route
{
    public static function api($prefix, $controller,$route)
    {
        $prefix = trim($prefix, '/') . '/';
        $namespace ='App\Http\Controllers\Api';

        try {
            $route->get($prefix, ['uses' => $controller . '@getIndex', 'as' => $controller . 'GetIndex']);

            $controller_class = new \ReflectionClass($namespace . '\\' . $controller);

            $controller_methods = $controller_class->getMethods(\ReflectionMethod::IS_PUBLIC);


            $wildcards = '';
            foreach ($controller_methods as $method) {


                if ($method->class != 'Illuminate\Routing\Controller' && $method->name != 'getIndex') {


                    if (substr($method->name, 0, 3) == 'get') {

                        $method_name = substr($method->name, 3);
                        $slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
                        $slug = strtolower(implode('-', $slug));
                        $slug = ($slug == 'index') ? '' : $slug;

                        $parameter = $method->getParameters();
                        $wildcards = '';
                        foreach ($parameter as $q){
                            $wildcards .= '/{'.$q->name.'}';
                        }



                        $route->get($prefix.$slug.$wildcards , ['uses' => $controller . '@' . $method->name, 'as' => $controller . 'Get' . $method_name]);
                    } elseif (substr($method->name, 0, 4) == 'post') {
                        $method_name = substr($method->name, 4);

                        $parameter = $method->getParameters();
                        $wildcards = '';
                        foreach ($parameter as $q){
                            $wildcards .= '/{'.$q->name.'}';
                        }

                        $slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
                        $route->post($prefix.strtolower(implode('-', $slug)).$wildcards, [
                            'uses' => $controller . '@' . $method->name,
                            'as' => $controller . 'Post' . $method_name,
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {

        }
    }

    public static function admin($prefix, $controller,$route)
    {
        $prefix = trim($prefix, '/') . '/';
        $namespace = 'App\Http\Controllers\Admin';

        try {
            $route->get($prefix, ['uses' => $controller . '@getIndex', 'as' => $controller . 'GetIndex']);
            $route->post($prefix, ['uses' => $controller . '@postIndex', 'as' => $controller . 'PostIndex']);

            $controller_class = new \ReflectionClass($namespace . '\\' . $controller);

            $controller_methods = $controller_class->getMethods(\ReflectionMethod::IS_PUBLIC);


            $wildcards = '';
            foreach ($controller_methods as $method) {


                if ($method->class != 'Illuminate\Routing\Controller' && $method->name != 'getIndex') {


                    if (substr($method->name, 0, 3) == 'get') {

                        $method_name = substr($method->name, 3);
                        $slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
                        $slug = strtolower(implode('-', $slug));
                        $slug = ($slug == 'index') ? '' : $slug;

                        $parameter = $method->getParameters();
                        $wildcards = '';
                        foreach ($parameter as $q){
                            $wildcards .= '/{'.$q->name.'}';
                        }



                        $route->get($prefix.$slug.$wildcards , ['uses' => $controller . '@' . $method->name, 'as' => $controller . 'Get' . $method_name]);
                    } elseif (substr($method->name, 0, 4) == 'post') {
                        $method_name = substr($method->name, 4);

                        $parameter = $method->getParameters();
                        $wildcards = '';
                        foreach ($parameter as $q){
                            $wildcards .= '/{'.$q->name.'}';
                        }

                        $slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
                        $route->post($prefix.strtolower(implode('-', $slug)).$wildcards, [
                            'uses' => $controller . '@' . $method->name,
                            'as' => $controller . 'Post' . $method_name,
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {

        }
    }
}

