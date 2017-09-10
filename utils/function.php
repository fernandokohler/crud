<?php
/**
 * Funções genéricas
 *
 * Created by PhpStorm.
 * User: luiz_
 * Date: 09/09/2017
 * Time: 22:49
 */

/**
 * Converte para o objeto especificado
 *
 * @param $destination
 * @param $sourceObject
 * @return mixed
 * @throws Exception
 */
function cast($destination, $sourceObject)
{
    try {
        $retorno = [];
        foreach ($sourceObject as $srcObj) {
            if (is_string($destination)) {
                $class_destination = new $destination();
            }
            $sourceReflection = new ReflectionObject($srcObj);
            $destinationReflection = new ReflectionObject($class_destination);
            $sourceProperties = $sourceReflection->getProperties();
            foreach ($sourceProperties as $sourceProperty) {
                $sourceProperty->setAccessible(true);
                $name = $sourceProperty->getName();
                $value = $sourceProperty->getValue($srcObj);
                if ($destinationReflection->hasProperty($name)) {
                    $propDest = $destinationReflection->getProperty($name);
                    $propDest->setAccessible(true);
                    $propDest->setValue($class_destination, $value);
                } else {
                    $class_destination->$name = $value;
                }
            }
            $retorno[] = $class_destination;
            unset($class_destination);
        }
        return $retorno;
    } catch (Exception $e) {
        throw new Exception("Erro ao converter para o objeto especificado -> " . $e->getMessage());
    }
}

/**
 * Converte o retorno do mysqli para um array de StdClass
 *
 * @param $arr
 * @return array
 * @throws Exception
 */
function arrayObjects($arr)
{
    try {
        $data = [];
        while ($obj = mysqli_fetch_object($arr)) {
            $data[] = $obj;
        }
        return $data;
    } catch (Exception $e) {
        throw new Exception("Erro ao converter -> " . $e->getMessage());
    }
}