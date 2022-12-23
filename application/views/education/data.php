<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data <?= $title ?></h4>
                    <div class="pull-right">
                        <a href="<?= site_url('admin/user/add') ?>" class="btn btn-primary btn-flat">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>School name</th>
                                        <th>Entry year</th>
                                        <th>End Year</th>
                                        <th>Study program</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($education as $key => $data) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data['sekolah']; ?></td>
                                            <td><?= $data['yearIn']; ?></td>
                                            <td><?= $data['yearEnd']; ?></td>
                                            <td><?= $data['program']; ?></td>
                                            <td>

                                                <a href="<?= base_url('admin/user/edit/') . $data['id_user'] ?>" class="btn btn-circle btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                                                <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('admin/user/delete/') . $data['id_user'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>