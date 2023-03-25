<?=$this->extend('layout/template');?>

<?=$this->section('content');?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-2">Detail Komik <?=$komik['judul'];?></h3>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?=$komik['sampul'];?>" class="card-img" alt="Sampul Komik <?=$komik['judul'];?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?=$komik['judul'];?></h5>
                            <p class="card-text"><b>Penulis : </b><?=$komik['penulis'];?>.</p>
                            <p class="card-text"><small class="text-muted"><b>Penerbit : </b> <?=$komik['penerbit'];?></small></p>
                            <a href="/komik/edit/<?=$komik['slug'];?>" class="btn btn-info btn-sm">Edit</a>
                            <form action="/komik/<?=$komik['id'];?>" method="POST" class="d-inline">
                                <?=csrf_field();?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Delete</button>
                            </form>
                            <a href="/komik" class="btn btn-warning btn-sm">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection();?>