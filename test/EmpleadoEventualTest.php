<?php
	require_once 'EmpleadoTest.php';
	
    class EmpleadoEventualTest extends EmpleadoTest{
        //Funcion Crear
		public function crear(  $nombre='German', $apellido ='Gimenez', $dni=30658947, $salario = 3000,
								$montos = [200,250,300,350]){

							   $empev = new \App\EmpleadoEventual($nombre,$apellido, $dni, $salario, $montos);
							   return $empev;
		}

        //Probar que el método calcularComision() funciona como se espera.

		public function testComisionPorVentasFuncionaCorrectamente(){

		//(200+250+300+350)/4)*0,1 = 27,5

			$empev= $this->crear();			 
			$this-> assertEquals(27.5,$empev->calcularComision()); 
		}

        //Probar que el método calcularIngresoTotal() funciona como se espera.

		public function testCalculoDelIngresoTotalEsCorrecto(){

			$empev=$this->crear();
			$this->assertEquals(3027.5,$empev->calcularIngresoTotal());
		}

        //Probar que si intento construir un empleado
		//proporcionando algún monto de venta negativo o cero, lanza una excepción.

		public function testNoSePuedeConstruirConMontoDeVentaNegativoOCero(){

			$this->expectException(\Exception::class); 
			$ventas = [0,-100, 250, 300];
			$empev = $this->crear(null,null,null,$ventas);
		}
		
	}
?>