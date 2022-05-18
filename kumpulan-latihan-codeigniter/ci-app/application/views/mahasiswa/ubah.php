<div class="container">

    <div class="row mt3">
        <div class="col-md-6">

            <div class="card mt-3">
                <div class="card-header">
                    Ubah Data Mahasiswa
                </div>
                <div class="card-body">
                    <form action="" method="post">

                        <input type="hidden" name="id" value="<?= $mahasiswa['id']; ?>">

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="<?= $mahasiswa['nama']; ?>">
                            <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="npm">NPM</label>
                            <input type="text" name="npm" class="form-control" id="npm" placeholder="NPM" value="<?= $mahasiswa['npm']; ?>">
                            <small class="form-text text-danger"><?= form_error('npm'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?= $mahasiswa['email']; ?>">
                            <small class="form-text text-danger"><?= form_error('email'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" name="jurusan" id="jurusan">
                                <?php foreach ($jurusan as $j) : ?>
                                    <?php if ($j['jurusan'] == $mahasiswa['jurusan']) : ?>
                                        <option value="<?= $j['jurusan']; ?>" selected><?= $j['jurusan']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $j['jurusan']; ?>"><?= $j['jurusan']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" name="ubah" class="btn btn-primary float-right">Ubah Data</button>

                    </form>
                </div>
            </div>


        </div>
    </div>

</div>