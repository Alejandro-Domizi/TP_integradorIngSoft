<?php

	abstract class EmpleadoDatosTest extends \PHPUnit\Framework\TestCase{

		// Funcion crear
		public function crear ($nombre = "Alejandro", $apellido = "Scozzatti", $dni = 31415926, $salario = 2000, $sector = "indefinido")
		{
			$emp = new \App\Empleado ($nombre, $apellido, $dni, $salario, $sector);
			return $emp;
		}

		//Crear test Nombre Y Apellido

		public function testCrearNombreYApellido(){
			$emp = $this->crear();
			$this->assertEquals("German Gimenez", $emp->getNombreApellido());
		}
		//crear test DNI

		public function testCrearDNI(){
			$emp = $this->crear();
			$this->assertEquals(30658947, $emp->getDNI());
		}

		//crear test Salario

		public function testCrearSalario(){
			$emp = $this->crear();
			$this->assertEquals(3000,$emp->getSalario());
		}

		//crear test getSector Y setSector

		public function testSePuedeCambiarElSectorDelEmpleado(){
			$emp=$this->crear();
			$seccion = "otro";
			$this->assertEquals("No especificado",$emp->getSector());

			//seteo el sector que le asigno
			$emp->setSector($seccion);

			//pruebo si se asigno correctamente
			$this->assertEquals("otro",$emp->getSector());
		}

		// crear test __toString

		public function testConvertirObjetoEnUnaCadena(){
			$emp=$this->crear();
			$this->assertEquals("German Gimenez 30658947 3000",$emp);
		}

        //Probar que si intento construir un empleado con el nombre vacío, lanza una excepción.

		public function testSiSeIntentaConstruirEmpleadoConElNombreVacio(){
			$this->expectException(\Exception::class);
			$emp= $this-> crear($nombre="");
		}

		//Probar que si intento construir un empleado con el apellido vacío, lanza una excepción.

		public function testSiSeIntentaConstruirEmpleadoConElApellidoVacio(){
			$this->expectException(\Exception::class);
			$emp= $this-> crear($nombre="Juan", $Apellido="");
		}

		//Probar que si intento construir un empleado con el dni vacío, lanza una excepción.

		public function testSiSeIntentaConstruirEmpleadoConElDniVacio(){
			$this->expectException(\Exception::class);
			$emp= $this-> crear(null, null,$dni="");
		}

        //Probar que si intento construir un empleado con el salario vacío, lanza una excepción.

		public function testSiSeIntentaConstruirEmpleadoConElSalarioVacio(){
			$this->expectException(\Exception::class);
			$emp= $this-> crear(null, null, null,$Salario="");
		}

		//Probar que si intento construir un empleado cuyo DNI contenga letras 
		//o caracteres no numéricos, lanza una excepción.

		public function testSiSeIntentaConstruirEmpleadoConElDniQueContengaLetras(){
			$this->expectException(\Exception::class);
			$emp= $this-> crear(null, null, "30DNI578");
		}

		//Probar que si, al intentar construir un empleado, no se especifica el sector, 
		//el método getSector debe devolver la cadena “No especificado”

		public function testNoSeEspecificaElSectorDevuelveNoEspecificado(){
			$emp= $this-> crear("Juan", "Fernandez", 35999625, 5000);
			$this->assertEquals("No especificado", $emp->getSector());
		}
	}
?>