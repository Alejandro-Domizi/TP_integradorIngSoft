<?php
	require_once 'EmpleadoTest.php';
	
	class EmpleadoPermanenteTest extends EmpleadoTest{
		
		//Funcion crear
		public function crear($nombre="German", $apellido="Gimenez", $dni=30658947, $salario=3000, $fechaIngreso=null){
			$fecha = new \DateTime();
			$empper = new \App\EmpleadoPermanente($nombre, $apellido, $dni, $salario, $fechaIngreso);
			return $empper;
		}
		//Probar que el método getFechaIngreso() funciona como se espera.

		public function testSePuedeGenerarYConseguirFechaIngreso(){
			$hoy = new DateTime();
			$empper= $this->crear();
			$this->assertEquals($hoy->format('Y-m-d'), $empper->getFechaIngreso()->format('Y-m-d'));
		}

		//Probar que el método calcularComision() funciona como se espera.

		public function testCalcularComisionBasadaEnLaAntiguedad(){
			$ingreso = new DateTime();
			$ingreso->modify('-20 years');
			$empper= $this->crear('German','Gimenez','30658947','3000', $ingreso); 
			$this->assertEquals("20%",$empper->calcularComision());
		}

        //Probar que el método calcularIngresoTotal() funciona como se espera.

		public function testSePuedeCalcularElIngresoTotal(){
			$ingreso = new DateTime();
			$ingreso->modify('-20 years');
			$empper= $this->crear('German','Gimenez','30658947','3000', $ingreso); 
			$this->assertEquals(3600,$empper->calcularIngresoTotal());
		}

		//Probar que el método calcularAntiguedad() funciona como se espera 
		//para un empleado con varios años de antigüedad.

		public function testSePuedeCalcularAntiguedad(){
			$ingreso = new DateTime();
			$ingreso->modify('-20 years');
			$empper= $this->crear('German','Gimenez','30658947','3000', $ingreso);
			$this->assertEquals(20,$empper->calcularAntiguedad());
		}

        //Probar que, si construyo un empleado sin proporcionar la fecha de ingreso, 
		//el método getFechaIngreso() retorna la fecha del día, y el método getAntiguedad retorna 0
        

		

        //Probar que, si construyo un empleado 
		//proporcionando una fecha de ingreso posterior a la de hoy, lanza una excepción.

		public function testNoSePuedeCrearConFechaPosteriorAlDiaDeHoy(){
			$ingreso = new DateTime();
			$ingreso->modify('+5 years'); //le sumo 5 años a la fecha creada
			$this->expectException(\Exception::class);
			$empper= $this->crear('German','Gimenez','30658947','3000', $ingreso); //tiro la excepcion al instanciar
		}
		
	}
?>