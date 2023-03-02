<?php require_once("../controller/script.php"); ?>

<div class="row">

  <!-- Tab panes -->
  <div class="col-md-12 mt-3">
    <h2>-</h2>
    <div class="col-10">
      <div class="card border-0 rounded-0">
        <div class="card-body">
          <h3>-</h3>
          <p>-</p>
        </div>
      </div>
    </div>
  </div>

</div>

<script src="../assets/datatable/datatables.js"></script>
<script>
  $(document).ready(function() {
    $("#datatable").DataTable();
  });
</script>
<script>
  (function() {
    function scrollH(e) {
      e.preventDefault();
      e = window.event || e;
      let delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
      document.querySelector(".table-responsive").scrollLeft -= (delta * 40);
    }
    if (document.querySelector(".table-responsive").addEventListener) {
      document.querySelector(".table-responsive").addEventListener("mousewheel", scrollH, false);
      document.querySelector(".table-responsive").addEventListener("DOMMouseScroll", scrollH, false);
    }
  })();
</script>