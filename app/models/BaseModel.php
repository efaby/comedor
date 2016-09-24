<?php

class BaseModel
{
	private $pdo;	

	private function openConexion(){		
		try{
			$this->pdo = new PDO('mysql:host='.HOSTNAME_DATABASE.';dbname='.DATABASE.';charset=utf8', USERNAME, PASSWORD);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	private function closeConexion(){
		$this->pdo =  null;
	}

	public function execSql($sql,$parameters, $list = false, $obtainId = false){
		
		try	{
			$this->openConexion();		
			$stm = $this->pdo->prepare($sql);
			$stm->execute($parameters);
			if($obtainId){
				$result = $this->pdo->lastInsertId();
			} else {
				if($list){
					$result = $stm->fetchAll(PDO::FETCH_OBJ);				
				} else {
					$result = $stm->fetch(PDO::FETCH_OBJ);
				}			
			}
			$this->closeConexion();
			
		}catch(Exception $e){
			die($e->getMessage());
		}
		return $result;
	}
	
	public function getCatalogo($tabla){
		$sql = "Select * from ".$tabla." where activo = 1";
		return $this->execSql($sql, array(),true);
	}
	
	public function saveDatos($objeto,$tabla){
		$id = $objeto["id"];
		unset($objeto["id"]);		
		$values = "";
		$keys = "";
		$usuarioData = array();
		foreach ($objeto as $key => $value){
			if($id == 0){
				$values .= ($values == '')?"?":" ,?";
				$keys .= ($keys == '')?$key:' ,'.$key;
			} else {
				$values .= ($values == '')? $key ." = ?":" ,".$key ." = ?";				
			}
			$usuarioData[] = $value;
		}		
		
		if($id == 0){
			$sql = ' Insert into '.$tabla. ' ('.$keys.') values ('.$values.')';
		} else {
			$sql = 'Update '.$tabla. ' set '.$values.' where id = ?';
			$usuarioData[] = $id;
		}

		return $this->execSql($sql, $usuarioData,false,true);
	}
	
	public function saveMultipleData($fieldsGeneral, $general, $fieldsListado, $listado){
		
		$this->openConexion();
		try	{
			
			$this->pdo->beginTransaction();
			
			$args = array_fill(0, count($general), '?');
			
			$sql = "INSERT INTO confronta_general (" . implode( ',', ( $fieldsGeneral ) ) . ") VALUES (".implode(',', $args).")";
			
			$stm = $this->pdo->prepare($sql);
			$stm->execute($general);			
			$result = $this->pdo->lastInsertId();
			
			$args = array_fill(0, count($listado[0]) + 1, '?');
			$sql = "INSERT INTO confronta (" . implode( ',', ( $fieldsListado ) ) . ") VALUES (".implode(',', $args).")";	
			
			$stm = $this->pdo->prepare($sql);
			
			foreach ($listado as $row){
				$row[] = $result;				
				$stm->execute($row);
			}			
			$this->pdo->commit();				
		} catch(PDOException $ex) {
		    //Something went wrong rollback!
		    $this->pdo->rollBack();
		    die($ex->getMessage());
		}
		
		$this->closeConexion();		
	}
	
}
