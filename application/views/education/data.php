<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data <?= $title ?></h4>
                    <div class="pull-right">
                        <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fa fa-plus"></i> Add
                        </button>
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


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add new recap education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('dashboard')?>" method="POST">
                <div class="modal-body">
                    <!-- Modal body free text -->
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">School name</label>
                                    <input type="text" id="first-name-vertical" class="form-control" name="school" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="yearPicker">Entry Year</label>
                                    <input type="text" id="yearPicker" class="form-control" name="yearIn" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-info-vertical">End Year</label>
                                    <input type="text" id="contact-info-vertical" class="form-control" name="contact" placeholder="Mobile">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password-vertical">Study Program</label>
                                    <input type="text" id="password-vertical" class="form-control" name="contact" placeholder="Password">
                                    <small style="color: #f71911;">(If not a university, please leave blank this form)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end modal body  -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>

