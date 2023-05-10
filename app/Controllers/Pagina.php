<?php
namespace App\Controllers;

use App\Models\ModelPagina;

class Pagina extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->paginas = new ModelPagina();
	}

	public function index() {
		$datos = $this->datosPrincipales();
		$datos['titulo'] = 'Página';
		if ($this->session->get('Usuario')) return view('crud/pagina', $datos);
        else return redirect()->to(base_url());
	}

    public function validar() {
		$nombre = $this->request->getPost('nombre');
		$imagen = $this->request->getFile('imagen');
		$pagina = $this->paginas->first();
		$campos = ''; $mensajes = ''; $contador = 0;
		if (!$nombre) {
			$contador++; $campos .= 'nombre,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (($imagen == null) && (!$pagina['Imagen'])) {
			$contador++; $campos .= 'imagen,';
			$mensajes .= 'El archivo es obligatorio,';
		} else if ($imagen <> null) {
			$extension = $imagen->getExtension();
			if ($extension <> 'png') {
				$contador++; $campos .= 'imagen,';
				$mensajes .= 'El archivo debe tener la extensión .png,';
			}
		}
		$json = array(
			'contador' => $contador,
			'mensajes' => $mensajes,
			'campos' => $campos
		);
		return json_encode($json);
    }

	public function guardar() {
		$nombre = ucwords($this->request->getPost('nombre'));
		$imagen = $this->request->getFile('imagen');
		$pagina = $this->paginas->first();
		if (!$pagina) return 'danger';
		if ($imagen <> null) $ruta = $this->subirArchivo($imagen, '', 'logo', 128, 128);
		else $ruta = $pagina['Imagen'];
		$this->paginas->set([
			'Nombre' => $nombre,
			'Imagen' => $ruta,
		])->update();
		return 'success';
    }
}