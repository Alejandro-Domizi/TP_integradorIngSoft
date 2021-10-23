<?php

	abstract class EmpleadoTest extends \PHPUnit\Framework\TestCase{

		// Funcion crear
		public function crearDefault($nombre = "Alejandro", $apellido = "Scozzatti", $dni = 77777777, $salario = 12000)
		{
			$emp = new \App\Empleado ($nombre, $apellido, $dni, $salario);
			return $emp;
		}

		//test getNombreApellido

		public function testCrearNombreYApellido(){
			$emp = $this->crearDefault();
			$this->assertEquals("Alejandro Scozzatti", $emp->getNombreApellido());
		}
		//test getDni

		public function testCrearDNI(){
			$emp = $this->crearDefault();
			$this->assertEquals(77777777, $emp->getDni());
		}

		//test getSalario

		public function testCrearSalario(){
			$emp = $this->crearDefault();
			$this->assertEquals("12000",$emp->getSalario());
		}

		//test getSector Y setSector

		public function testSePuedeCambiarElSectorDelEmpleado(){
			$emp=$this->crearDefault();
			$seccion = "FrontEnd";
			$this->assertEquals("No especificado",$emp->getSector());

			//seteo el sector que le asigno
			$emp->setSector($seccion);

			//pruebo si se asigno correctamente
			$this->assertEquals("FrontEnd",$emp->getSector());
		}

		//test __toString

		public function testConvertirObjetoEnUnaCadena(){
			$emp=$this->crearDefault();
			$this->assertEquals("Alejandro Scozzatti 77777777 12000",$emp);
		}

        //Probar que si intento construir un empleado con el nombre vacío, lanza una excepción.

		public function testSiSeIntentaConstruirEmpleadoConElNombreVacio(){
			$this->expectException(\Exception::class);
			$this-> crearDefault("","Scozzatti", 77777777, 12000);
		}

		//Probar que si intento construir un empleado con el apellido vacío, lanza una excepción.

		public function testSiSeIntentaConstruirEmpleadoConElApellidoVacio(){
			$this->expectException(\Exception::class);
			$this-> crearDefault("Alejandro","", 77777777, 12000);
		}

		//Probar que si intento construir un empleado con el dni vacío, lanza una excepción.

		public function testSiSeIntentaConstruirEmpleadoConElDniVacio(){
			$this->expectException(\Exception::class);
			$this-> crearDefault("Alejandro","Scozzatti", "", 12000);
		}

        //Probar que si intento construir un empleado con el salario vacío, lanza una excepción.

		public function testSiSeIntentaConstruirEmpleadoConElSalarioVacio(){
			$this->expectException(\Exception::class);
			$this-> crearDefault("Alejandro","Scozzatti", 77777777, "");
		}

		//Probar que si intento construir un empleado cuyo DNI contenga letras 
		//o caracteres no numéricos, lanza una excepción.

		public function testSiSeIntentaConstruirEmpleadoConElDniQueContengaLetras(){
			$this->expectException(\Exception::class);
			$this-> crearDefault("Alejandro","Scozzatti", 77DNI777, 12000);
		}

		//Probar que si, al intentar construir un empleado, no se especifica el sector, 
		//el método getSector debe devolver la cadena “No especificado”

		public function testNoSeEspecificaElSectorDevuelveNoEspecificado(){
			$emp= $this-> crearDefault("Juan", "Fernandez", 35999625, 20000);
			$this->assertEquals("No especificado", $emp->getSector());
		}
	}
?>