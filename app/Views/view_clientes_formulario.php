<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clientes - Formulário</title>
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
      <div class="col">
        <h1 class="display-6"><?= isset($cliente['id']) ? 'Editar Cliente' : 'Novo Cliente' ?></h1>
      </div>
    </div>
    <form action="<?= base_url('clientes/salvar' . (isset($cliente['id']) ? '/' . $cliente['id'] : '')) ?>" method="post" enctype="multipart/form-data" class="mt-4">
      <?= csrf_field() ?>
      <div class="row">
        <div class="col-12 mb-3">
          <label for="nome" class="form-label">Nome Completo <small class="text-danger">*</small></label>
          <input type="text" class="form-control" id="nome" name="nome" value="<?= esc(old('nome', $cliente['nome'] ?? '')) ?>" required>
        </div>
        <div class="col-12 mb-3">
          <label for="email" class="form-label">E-mail <small class="text-danger">*</small></label>
          <input type="email" class="form-control" id="email" name="email" value="<?= esc(old('email', $cliente['email'] ?? '')) ?>" required>
        </div>
        <div class="col-12 mb-3">
          <label for="telefone" class="form-label">Telefone/Celular <small class="text-danger">*</small></label>
          <input type="text" class="form-control" id="telefone" name="telefone" value="<?= esc(old('telefone', $cliente['telefone'] ?? '')) ?>" required>
        </div>
        <div class="col-12 mb-3">
          <label for="foto" class="form-label">Foto <small class="text-danger"><?= empty($cliente['foto']) ? '*' : '' ?></small></label>
          <input class="form-control" type="file" id="foto" name="foto" accept=".png,.jpg" <?= empty($cliente['foto']) ? 'required' : '' ?>>
          <span id="passwordHelpInline" class="form-text">
            Máximo: 2MB | Formatos aceitos: PNG/JPG
          </span>
        </div>
        <?php if (!empty($cliente['foto'])) { ?>
          <div class="mb-3">
            <label class="form-label">Foto atual:</label><br>
            <img src="<?= base_url('uploads/' . esc($cliente['foto'])) ?>" alt="<?= esc($cliente['nome'] ?? '') ?>" class="img-thumbnail" width="200">
          </div>
        <?php } ?>
      </div>
      <a type="button" class="btn btn-secondary" href="<?= base_url('/clientes') ?>">Voltar</a>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/imask"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toastElement = document.getElementById('toastMsg');
      if (toastElement) {
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
      }

      IMask(document.getElementById("telefone"), {
        mask: [{
            mask: '(00) 0000-0000'
          },
          {
            mask: '(00) 00000-0000'
          }
        ]
      });
    });
  </script>

</body>

</html>