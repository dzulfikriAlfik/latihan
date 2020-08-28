<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Dashboard</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active">Dashboard</li>
            </ol>
         </div>
      </div>
   </div>
</section>

<!-- Main content -->
<section class="content">

   <div class="container-fluid">
      <div class="row">
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
               <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

               <div class="info-box-content">
                  <span class="info-box-text">Items</span>
                  <span class="info-box-number">
                     <?= count_rows('p_item') ?>
                  </span>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
               <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-truck"></i></span>

               <div class="info-box-content">
                  <span class="info-box-text">Suppliers</span>
                  <span class="info-box-number"><?= count_rows('supplier'); ?></span>
               </div>
            </div>
         </div>

         <div class="clearfix hidden-md-up"></div>

         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
               <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

               <div class="info-box-content">
                  <span class="info-box-text">Customers</span>
                  <span class="info-box-number"><?= count_rows('customer'); ?></span>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
               <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-plus"></i></span>

               <div class="info-box-content">
                  <span class="info-box-text">Users</span>
                  <span class="info-box-number"><?= count_rows('user'); ?></span>
               </div>
            </div>
         </div>
      </div>
   </div>

</section>