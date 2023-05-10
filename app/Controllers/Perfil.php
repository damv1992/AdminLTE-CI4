<?php
namespace App\Controllers;

use App\Models\ModelPagina;
use App\Models\ModelUsuario;

class Perfil extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->paginas = new ModelPagina();
		$this->usuarios = new ModelUsuario();
	}

    public function index() {
		$pagina = $this->paginas->first();
		$datos = $this->datosPrincipales();
        $perfil = $this->usuarios->where('IdUsuario', $this->session->get('IdUsuario'))->first();
        $datos['titulo'] = 'CUENTA';
        $datos += [
            'perfil' => $perfil
        ];
        return view('usuario/perfil', $datos);
    }

    public function validar() {
		$imagen = $this->request->getFile('imagen');
		$campos = ''; $mensajes = ''; $contador = 0;
		if ($imagen <> null) {
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
		$contraseña = $this->request->getPost('contraseña');
		$imagen = $this->request->getFile('imagen');
		$telefono = $this->request->getPost('telefono');
        $perfil = $this->usuarios->where('IdUsuario', $this->session->get('IdUsuario'))->first();
		if (!$perfil) return 'danger';
		if ($imagen <> null) $ruta = $this->subirArchivo($imagen, 'usuarios', $perfil['IdUsuario'], 160, 160);
		else if ($perfil['Imagen']) $ruta = $perfil['Imagen'];
        else $ruta = null;
		if ($contraseña) $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
		else $contraseña = $perfil['Contraseña'];
		$this->usuarios->set([
			'Contraseña' => $contraseña,
			'Imagen' => $ruta,
			'Telefono' => $telefono,
		])->where('IdUsuario', $perfil['IdUsuario'])->update();
        $this->session->destroy();
		return 'success';
    }
}