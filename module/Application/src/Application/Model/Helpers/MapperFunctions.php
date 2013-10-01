<?php

namespace Application\Model\Helpers;

abstract class MapperFunctions {
	/*abstract public function __set($name, $value);
	abstract public function __get($name);
	*/
	public function exchangeArray($data) {
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

	/**
     * Get array for columns
     *
     * @param bool    	$forSelectColumns     Set ket and value as columns names
     * @param string    $alias        		  Append column names with alias
     */
	public function getArrayCopy($forSelectColumns = FALSE, $alias = NULL) {
		$columns = get_object_vars($this);
		if($forSelectColumns === TRUE) {
			unset($columns['joins']);
			foreach ($columns as $key => $value) {
				if($alias === NULL)
					$columns[$key] = $key;
				else if(is_string($alias))  {
					unset($columns[$key]);
					$columns[$alias.'_'.$key] = $key;
				}
			}
		}
		return $columns;
	}

    public function getNotNullArrayCopy($forInsert = TRUE) {
        $data = $this->getArrayCopy();
        foreach ($data as $dKey => $dValue) {
            if($dValue === NULL) {
                unset($data[$dKey]);
            }
        }
        if($forInsert === TRUE) {
            unset($data['joins']);
        }
        return $data;
    }

    public function __set($name, $value) {
        list($alias, $column) = explode('_', $name, 2);

        if(!isset($this->joins[$alias])) {
            return;
        }
        $this->joins[$alias][$column] = $value;
    }

    public function __get($name) {
        list($alias, $column) = explode('_', $name, 2);

        if(!isset($this->joins[$alias])) {
            return NULL;
        }

        if($column == NULL)
            return $this->joins[$alias];
        if(isset($this->joins[$alias][$column]))
            return $this->joins[$alias][$column];

        return NULL;
    }
}