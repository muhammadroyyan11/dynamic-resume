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
                                        <th>Institute</th>
                                        <th>Desc</th>
                                        <th>Date In</th>
                                        <th>Date End</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($education as $key => $data) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data->company ?></td>
                                            <td><?= $data->desc ?></td>
                                            <td><?= $data->dateIn ?></td>
                                            <td><?= $data->dateEnd ?></td>
                                            <td>
                                                <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('admin/user/delete/') . $data->id_ex ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Add new recap experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('experience/proses') ?>" method="POST">
                <div class="modal-body">
                    <!-- Modal body free text -->
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">Company name</label>
                                    <input type="text" id="first-name-vertical" class="form-control" name="company" placeholder="Company name" autocomplete="off">
                                    <small>eg: PT SIDO MAKMUR Tbk,</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">Description</label><br>
                                    <textarea name="desc" cols="60" rows="10" autocomplete="off"></textarea>
                                    <small>entry your activity on your description</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="yearPicker">Date Join</label>
                                    <input type="date" id="yearPicker" class="form-control" name="dateIn" placeholder="Entry Year" autocomplete="off">
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password-vertical">Still working there?</label>
                                    <select name="confirm" id="confirmation" class="form-control">
                                        <option value="Now">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div id="dateIn" class="col-12">
                                <div class="form-group">
                                    <label for="contact-info-vertical">Date Leave</label>
                                    <input type="date" id="dateEnd" class="form-control" name="dateEnd" placeholder="End Year" autocomplete="off">
                                </div>
                            </div>

                            <!-- <div class="col-12">
                                <div class="form-group">
                                    <label for="password-vertical">Study Program</label>
                                    <input type="text" id="password-vertical" class="form-control" name="program" placeholder="Enter Your Study Program" autocomplete="off">
                                    <small style="color: #f71911;">(If not a university, please leave blank this form)</small>
                                </div>
                            </div> -->
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