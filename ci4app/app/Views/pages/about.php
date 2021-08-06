<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row">
      <div class="col">
         <h2>About Me</h2>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus commodi hic dolorem maiores, aut quaerat dicta tenetur porro nam. Eligendi asperiores ea necessitatibus exercitationem magni accusamus laboriosam dolores cum facere.</p>
         <?php d($array) ?>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>