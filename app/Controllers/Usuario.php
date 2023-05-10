<?php
namespace App\Controllers;

use App\Models\ModelPagina;
use App\Models\ModelUsuario;

class Usuario extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->paginas = new ModelPagina();
		$this->usuarios = new ModelUsuario();
	}

    public function index() {
		$datos = $this->datosPrincipales();
        $datos['titulo'] = 'Usuarios';
        $roles = $this->usuarios->groupBy('RolAsignado')->findAll();
		$datos += [
			'roles' => $roles,
		];
		if ($this->session->get('Usuario')) return view('crud/usuario/lista', $datos);
        else return redirect()->to(base_url());
	}

    public function agregar() {
		$datos = $this->datosPrincipales();
        $datos['titulo'] = 'Agregar usuario';
		if ($this->session->get('Usuario')) return view('crud/usuario/formulario', $datos);
        else return redirect()->to(base_url());
	}

	public function editar($id) {
		$datos = $this->datosPrincipales();
		$usuario = $this->usuarios->where('IdUsuario', $id)->first();
        $datos['titulo'] = 'Modificar usuario';
		$datos += [
			'usuario' => $usuario,
		];
		if ($this->session->get('Usuario')) return view('crud/usuario/formulario', $datos);
        else return redirect()->to(base_url());
	}

    public function listar() {
        $rol = $this->request->getPost('rol');
        if ($rol) $usuarioss = $this->usuarios->where('RolAsignado', $rol)->orderBy('Usuario ASC')->findAll();
        else $usuarioss = $this->usuarios->orderBy('Usuario ASC')->findAll();
		$cantidad = count($usuarioss);
		$datosJson = '{"data": [';
		$contador = 0;
		foreach ($usuarioss as $usuario) {
			$contador++;
			$url = site_url('usuario/editar/'.$usuario['IdUsuario']);
			$acciones = "<div class='btn-group'>";
			$acciones .= "<a href='".$url."' class='btn btn-warning'><i class='fa fa-pen'></i></a>";
			$acciones .= "<a class='btnBorrar btn btn-danger' codigo='".$usuario['IdUsuario']."'><i class='fa fa-trash'></i></a>";
			$acciones .= "</div>";
            if ($usuario['Telefono']) $telefono = "<a target='_blank' href='https://wa.me/".$usuario['Telefono']."'>+".$usuario['Telefono']."</a>";
            else $telefono = "";
            if ($usuario['Imagen']) $imagen = "<a href='".base_url($usuario['Imagen'])."'><img src='".base_url($usuario['Imagen'])."' height='40'></a>";
            else $imagen = "";

			$datosJson .= '[
				"' . $contador . '",
				"' . $usuario['Usuario'] . '",
				"' . $imagen . '",
				"' . $telefono . '",
				"' . $usuario['RolAsignado'] . '",
				"' . $acciones . '"
			],';
		}
		$datosJson = rtrim($datosJson, ",");
		$datosJson .= ']}';
		return $datosJson;
    }

    public function validar() {
		$id = $this->request->getPost('id');
		$usuario = $this->request->getPost('usuario');
		$contraseña = $this->request->getPost('contraseña');
		$rol = $this->request->getPost('rol');
		$existe = $this->usuarios->where('Usuario', $usuario)->first();
		$campos = ''; $mensajes = ''; $contador = 0;
		if (!$usuario) {
			$contador++; $campos .= 'usuario,';
			$mensajes .= 'Este dato es obligatorio,';
		} else {
            if ($existe && $existe['IdUsuario'] <> $id) {
                $contador++; $campos .= 'usuario,';
                $mensajes .= 'Ya existe este registro,';
            }
        }
        if (!$contraseña && !$id) {
			$contador++; $campos .= 'contraseña,';
			$mensajes .= 'Este dato es obligatorio,';
		}
        if (!$rol) {
			$contador++; $campos .= 'rol,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		$json = array(
			'contador' => $contador,
			'mensajes' => $mensajes,
			'campos' => $campos
		);
		return json_encode($json);
    }

	public function guardar() {
		$id = $this->request->getPost('id');
		$usuario = $this->request->getPost('usuario');
		$contraseña = $this->request->getPost('contraseña');
		$rol = $this->request->getPost('rol');

		if ($id) {
            $verificar = $this->usuarios->where('IdUsuario', $id)->first();
            if ($contraseña) $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
            else $contraseña = $verificar['Contraseña'];
			$this->usuarios->where([
				'IdUsuario' => $id,
			])->set([
                'Usuario' => $usuario,
                'Contraseña' => $contraseña,
                'RolAsignado' => $rol,
			])->update();
            if ($id == $this->session->get('IdUsuario')) $this->desconectar();
		} else {
			$id = $this->generarId();
			$this->usuarios->insert([
				'IdUsuario' => $id,
                'Usuario' => $usuario,
                'Contraseña' => password_hash($contraseña, PASSWORD_DEFAULT),
                'RolAsignado' => $rol,
			]);
		}
		return 'success';
    }

	public function borrar() {
		$id = $this->request->getPost('id');
		if (!$id) return "error";
		$this->usuarios->where('IdUsuario', $id)->delete();
		$verificar = $this->usuarios->where('IdUsuario', $id)->first();
		if ($verificar) return 'uso';
		return 'ok';
	}

	public function generarId() {
        $id = 0;
        while (true) {
            $id++;
            if (!$this->usuarios->where('IdUsuario', $id)->first()) return $id;
        }
	}

	public function conectar() {
        $usuario = $this->request->getPost('usuario');
        $contraseña = $this->request->getPost('contraseña');
        $campos = ''; $mensajes = ''; $contador = 0;
        $verificar = $this->usuarios->where('Usuario', $usuario)->first();
        if (!$usuario) {
            $contador++; $campos .= 'usuario,';
            $mensajes .= 'Este dato es obligatorio,';
        } else {
            if ($usuario != $verificar['Usuario']) {
                $contador++; $campos .= 'usuario,';
                $mensajes .= 'No existe ese registro,';
            }
        }
        if (!$contraseña) {
            $contador++; $campos .= 'contraseña,';
            $mensajes .= 'Este dato es obligatorio,';
        } else {
            if (!password_verify($contraseña, $verificar['Contraseña'])) {
                $contador++; $campos .= 'contraseña,';
                $mensajes .= 'Contraseña incorrecta,';
            }
        }
        $json = array(
            'contador' => $contador,
            'mensajes' => $mensajes,
            'campos' => $campos
        );
        if ($contador == 0) {
            $this->session->set($verificar);
        }
        return json_encode($json);
    }

    public function desconectar() {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}