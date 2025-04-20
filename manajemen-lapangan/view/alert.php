<?php if (isset($_GET['msg'])): ?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
  <?= htmlspecialchars($_GET['msg']) ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>
