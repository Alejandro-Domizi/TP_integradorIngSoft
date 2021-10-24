<?php
	require_once 'EmpleadoTest.php';
	
	class EmpleadoPermanenteTest extends EmpleadoTest{
		
		//Funcion crear
		public function crearDefault($nombre="Alejandro", $apellido="Scozzatti", $dni=77777777, $salario=12000, $fechaIngreso=null){
			$fecha = new \DateTime();
			$empper = new \App\EmpleadoPermanente($nombre, $apellido, $dni, $salario, $fechaIngreso);
			return $empper;
		}
		//Probar que el método getFechaIngreso() funciona como se espera.

		public function testConstruirFechaIngreso(){
			$hoy = new DateTime();
			$empper= $this->crearDefault();
			$this->assertEquals($hoy->format('Y-m-d'), $empper->getFechaIngreso()->format('Y-m-d'));
		}

		//Probar que el método calcularComision() funciona como se espera.

		public function testCalcularComisionBasadaEnLaAntiguedad(){
			$ingreso = new DateTime();
			$ingreso->modify('-20 years');
			$empper= $this->crearDefault('Alejandro','Scozzatti',7777777, 12000, $ingreso); 
			$this->assertEquals("20%",$empper->calcularComision());
		}

        //Probar que el método calcularIngresoTotal() funciona como se espera.

		public function testCalcularElIngresoTotal(){
			$ingreso = new DateTime();
			$ingreso->modify('-20 years');
			$empper= $this->crearDefault('Alejandro','Scozzatti', 77777777, 12000, $ingreso); 
			$this->assertEquals(36000,$empper->calcularIngresoTotal());
		}

		//Probar que el método calcularAntiguedad() funciona como se espera 
		//para un empleado con varios años de antigüedad.

		public function testSePuedeCalcularAntiguedad(){
			$ingreso = new DateTime();
			$ingreso->modify('-20 years');
			$empper= $this->crearDefault('German','Gimenez', 77777777, 12000, $ingreso);
			$this->assertEquals(20,$empper->calcularAntiguedad());
		}

        //Probar que, si construyo un empleado sin proporcionar la fecha de ingreso, 
		//el método getFechaIngreso() retorna la fecha del día, y el método getAntiguedad retorna 0
        
		public function testSinProporcionarFechaDeIngreso()
		{
			$empleadoPe = $this->crearDefault("Alejandro", "Scozzatti", 77777777, 12000);
			$fecha = new DateTime(); 
			$this->assertEquals(date_format($fecha, 'y-m-d'), date_format($empleadoPe->getFechaIngreso(), 'y-m-d')); 
			$this->assertEquals(0, $empleadoPe->calcularAntiguedad()); 
		}
		

        //Probar que, si construyo un empleado 
		//proporcionando una fecha de ingreso posterior a la de hoy, lanza una excepción.

		public function testNoSePuedeCrearConFechaPosteriorAlDiaDeHoy(){
			$ingreso = new DateTime();
			$ingreso->modify('+5 years'); 
			$this->expectException(\Exception::class);
			$empper= $this->crearDefault('Alejandro','Scozzatti', 77777777, 12000, $ingreso); //tiro la excepcion al instanciar
		}
		
	}
?>