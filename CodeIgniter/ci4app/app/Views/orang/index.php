<?=$this->extend('layout/template');?>

<?=$this->section('content');?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Daftar orang</h1>
            <form action="" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan Keyword....." name="keyword" autofocus>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orang as $o): ?>
                    <tr>
                        <th scope="row"><?=$page++;?></th>
                        <td><?=$o['nama'];?></td>
                        <td><?=$o['alamat'];?></td>
                        <td>
                            <a href="/orang/<?=$o['id'];?>" class="btn btn-success btn-sm">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <?=$pager->links('orang', 'orang_pagination');?>
        </div>
    </div>
</div>
<?=$this->endSection();?>