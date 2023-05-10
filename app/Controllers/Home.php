<?php

namespace App\Controllers;

use App\Models\ModelPagina;
use App\Models\ModelUsuario;

class Home extends BaseController {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->paginas = new ModelPagina();
		$this->usuarios = new ModelUsuario();
	}

	public function index() {
		$pagina = $this->paginas->first();
		if (!$pagina) $this->generarPagina();

		$usuario = $this->usuarios->where('IdUsuario', 0)->first();
		if (!$usuario) $this->generarAdministrador();

		$datos = $this->datosPrincipales();

		if ($this->session->get('RolAsignado')) {
			$datos['titulo'] = 'Inicio';
			return view('index', $datos);
		}
		else {
			$datos['titulo'] = 'Iniciar Sesión';
			return view('usuario/login', $datos);
		}
	}
	
	public function datosPrincipales() {
		$pagina = $this->paginas->first();
		$datos = [
			'pagina' => $pagina,
			'titulo' => '',
		];
		return $datos;
	}

	public function subirArchivo($archivo, $carpeta, $nombre, $ancho, $alto) {
		$extension = $archivo->getExtension();
		$ruta = '/custom/img/';
		if ($carpeta) $ruta .= $carpeta.'/';
		$ruta .= $nombre.'.'.$extension;
		if (file_exists($ruta)) unlink('.'.$ruta);
		// Ingresar 0 para mantener tamaño
		if (($ancho == 0) || ($alto == 0))
			\Config\Services::image()
				->withFile($archivo)
				->save('.'.$ruta);
		else
			\Config\Services::image()
				->withFile($archivo)
				->resize($ancho, $alto, false, 'auto')
				->save('.'.$ruta);
		return $ruta;
	}

	public function generarPagina() {
		$this->paginas->insert([
			'Nombre' => 'AdminLTE',
			'Imagen' => '/custom/img/logo.png',
		]);
	}

	public function generarAdministrador() {
		$this->usuarios->insert([
			'IdUsuario' => 1,
			'Usuario' => 'memesis',
			'Contraseña' => password_hash('memesis', PASSWORD_DEFAULT),
			'Imagen' => '/custom/img/usuarios/0.png',
			'Telefono' => 59173354006,
			'RolAsignado' => 'Administrador',
		]);
	}

	public function error404() {
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Página de error 404',
		];
		return view('404', $datos);
	}
}
