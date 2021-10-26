<?php

require_once (dirname(__FILE__).'/../config/Conexion.php');

class AuthToken{


	private $conexion;
	private $pst;	
			 
	public function __construct(){
		$this->conexion= new Conexion();
		$this->pst= $this->conexion->getConectar();	
		
	}


	public function loginUsers($user, $pass){
		
		$sql = "SELECT p.id, p.names, p.foto, IFNULL(p.email , '') as email , p.idempresa, p.phone, p.state, u.password, u.role, u.intentos FROM persona as p inner join users as u on p.id = u.id_person where u.username =:user or p.email =:email and p.type = '2';";

		$statement = $this->pst->prepare($sql);

		$statement->bindParam(':user',$user, PDO::PARAM_STR);
		$statement->bindParam(':email',$user, PDO::PARAM_STR);	

		$res =$statement->execute();
		$arreglo=array();
		
		if($res){

			while($fila = $statement->fetch(PDO::FETCH_ASSOC)){			

				if($fila['state']=='1' && 1*$fila['intentos']<3){
					if(password_verify($pass,$fila['password'])){

						$arreglo[0]=1;
						$arreglo[1] = $fila['id'];
						$arreglo[2] = $fila['names'];
						$arreglo[3] = $fila['email'];
						$arreglo[4] = $fila['phone'];	
						$arreglo[5] = $fila['role'];
						$arreglo[6] = $fila['idempresa'];
						$arreglo[7] = $fila['foto'];

						if(1*$fila['intentos']>0){
							$query = "UPDATE users SET intentos = 0 where id_person=".$fila['id'];
							$this->pst->query($query);
						}

						return $arreglo;

					}else{

						$query = "";
						if(1*$fila['intentos']<4){
							$query = "UPDATE users SET intentos = intentos+1 where id_person=".$fila['id'];
						}else{
							$query = "UPDATE persona set state = 0 where id=".$fila['id'];
						}			

						$this->pst->query($query);

						$arreglo[0]=2;
						$arreglo[1]="Te quedan: ".(3-(1+$fila['intentos'])." Intentos");
						
						return $arreglo;				
					}

				}else{
					$arreglo[0]=3;
					$arreglo[1]="Tu Cuenta está Bloqueada, Comunicate con el administrador";
					return $arreglo;
				}
				
			}

			$arreglo[0]=4;
			$arreglo[1]="Cuenta no permitida, se bloquerá su ip";
			return $arreglo;
			
		}else{
			$arreglo[0]=4;
			$arreglo[1]="Cuenta no permitida";
			return $arreglo;
		}
	}


}