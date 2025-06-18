<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clientes - Listagem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
  <?php if (session()->has('errors')) { ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="toastMsg" class="toast bg-danger text-light" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m-2.715 5.933a.5.5 0 0 1-.183-.683A4.5 4.5 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.5 3.5 0 0 0 8 10.5a3.5 3.5 0 0 0-3.032 1.75.5.5 0 0 1-.683.183M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8" />
          </svg>
          <strong class="me-auto mx-2">Sistema</strong>
          <small>agora</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          <?php foreach (session('errors') as $erro) { ?>
            <p><?= esc($erro) ?></p>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (session()->has('msg')) { ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="toastMsg" class="toast bg-success text-light" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-laughing-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5c0 .501-.164.396-.415.235C6.42 6.629 6.218 6.5 6 6.5s-.42.13-.585.235C5.164 6.896 5 7 5 6.5 5 5.672 5.448 5 6 5s1 .672 1 1.5m5.331 3a1 1 0 0 1 0 1A5 5 0 0 1 8 13a5 5 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5m-1.746-2.765C10.42 6.629 10.218 6.5 10 6.5s-.42.13-.585.235C9.164 6.896 9 7 9 6.5c0-.828.448-1.5 1-1.5s1 .672 1 1.5c0 .501-.164.396-.415.235" />
          </svg>
          <strong class="me-auto mx-2">Sistema</strong>
          <small>agora</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          <p><?= session('msg') ?></p>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="container">
    <div class="row align-items-center mt-4">
      <div class="col-8">
        <h1 class="display-6">Listagem de Clientes</h1>
      </div>
      <div class="col-4 text-end">
        <a class="btn btn-primary" href="<?= base_url('/clientes/novo') ?>">Novo Cliente</a>
      </div>
    </div>
    <?php if (count($clientes) === 0) { ?>
      <div class="row">
        <div class="col mt-4">
          <div class="p-5 mb-4 bg-body-tertiary rounded-3 mt-4">
            <div class="container-fluid py-5">
              <h1 class="display-5 fw-bold">Nenhum cliente cadastrado...</h1>
              <p class="col-md-8 fs-4">Clique no botão abaixo para adicionar seu primeiro cliente</p> <a class="btn btn-primary btn-lg" href="<?= base_url('/clientes/novo') ?>">Novo Cliente</a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php if (count($clientes) > 0) { ?>
      <div class="row">
        <div class="col mt-4">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col" class="text-end"></th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Telefone</th>
                <th scope="col" class="text-end">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($clientes as $cliente) { ?>
                <tr>
                  <th scope="row" class="align-middle text-end" style="max-width: 50px;">
                    <img src="<?= base_url('uploads/' . esc($cliente['foto'])) ?>" class="rounded-circle" width="48" height="48" alt="<?= esc($cliente['nome']) ?>">
                  </th>
                  <td class="align-middle" class="text-center"><?= esc($cliente['nome']) ?></td>
                  <td class="align-middle"><?= esc($cliente['email']) ?></td>
                  <td class="align-middle"><?= esc($cliente['telefone']) ?></td>
                  <td class="align-middle text-end">
                    <a href="<?= base_url('/clientes/editar/' . esc($cliente['id'])) ?>" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-title="Editar">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                      </svg>
                    </a>
                    <button onclick="confirmacaoExcluirCliente(<?= esc($cliente['id']) ?>, '<?= esc($cliente['nome']) ?>')" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-title="Excluir">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                      </svg>
                    </button>
                  </td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>
      </div>
    <?php } ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toastElement = document.getElementById('toastMsg');
      if (toastElement) {
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
      }
    });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    function confirmacaoExcluirCliente(id, nome) {
      if (window.confirm(`Confirma excluir cliente ${nome}?`)) {
        window.location.href = `<?= base_url('/clientes/excluir') ?>/${id}`;
      }
    }
  </script>

</body>

</html>