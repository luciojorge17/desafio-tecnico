<?php

namespace App\Controllers;

class ClientesController extends BaseController
{
    public function listar()
    {
        $clienteModel = new \App\Models\ClienteModel();
        $clientes = $clienteModel->findAll();

        return view('view_clientes_listagem', ['clientes' => $clientes]);
    }

    public function novo()
    {
        return view('view_clientes_formulario');
    }

    public function editar($id)
    {
        $clienteModel = new \App\Models\ClienteModel();
        $cliente = $clienteModel->find($id);

        if (!$cliente) {
            return redirect()->to(base_url('/clientes'));
        }

        return view('view_clientes_formulario', ['cliente' => $cliente]);
    }

    public function salvar($id = null)
    {
        helper(['form']);
        $clienteModel = new \App\Models\ClienteModel();

        $fotoAntiga = null;

        if ($id) {
            $clienteExistente = $clienteModel->find($id);
            if (!$clienteExistente) {
                return redirect()->to(base_url('/clientes'))->with('errors', ['Cliente não encontrado.']);
            }
            $fotoAntiga = $clienteExistente['foto'] ?? null;
        }

        $regras = [
            'nome' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'telefone' => 'required|min_length[14]',
        ];

        if (!$id) {
            $regras['foto'] = 'uploaded[foto]|is_image[foto]|mime_in[foto,image/png,image/jpeg]|max_size[foto,2048]';
        } else {
            if ($this->request->getFile('foto')->getError() !== 4) { // 4 = no file uploaded
                $regras['foto'] = 'is_image[foto]|mime_in[foto,image/png,image/jpeg]|max_size[foto,2048]';
            }
        }

        if (!$this->validate($regras)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados = [
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $novoNomeFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads', $novoNomeFoto);
            $dados['foto'] = $novoNomeFoto;

            if ($id && $fotoAntiga && file_exists(FCPATH . 'uploads/' . $fotoAntiga)) {
                unlink(FCPATH . 'uploads/' . $fotoAntiga);
            }
        } elseif ($id && $fotoAntiga) {
            $dados['foto'] = $fotoAntiga;
        }

        if ($id) {
            $clienteModel->update($id, $dados);
        } else {
            $clienteModel->insert($dados);
        }

        return redirect()->to(base_url('/clientes'))->with('msg', 'Cliente salvo com sucesso!');
    }


    public function excluir($id)
    {
        $clienteModel = new \App\Models\ClienteModel();
        if ($clienteModel->delete($id)) {
            session()->setFlashdata('msg', 'Cliente excluído com sucesso!');
        } else {
            session()->setFlashdata('errors', ['Erro ao excluir cliente.']);
        }

        return redirect()->to('/clientes');
    }
}
