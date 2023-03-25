<?=$this->extend('layout/template');?>

<?=$this->section('content');?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Daftar Komik</h1>
            <a href="/komik/create" class="btn btn-primary btn-sm mb-3">Tambah Data Komik</a>
            <?php if (session()->getFlashdata('pesan')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?=session()->getFlashData('pesan');?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif;?>
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
                    <?php $no = 1;foreach ($komik as $k): ?>
                    <tr>
                        <th scope="row"><?=$no++;?></th>
                        <td><img src="/img/<?=$k['sampul'];?>" class="sampul" alt=""></td>
                        <td><?=$k['judul'];?></td>
                        <td>
                            <a href="/komik/<?=$k['slug'];?>" class="btn btn-success btn-sm">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?=$this->endSection();?>