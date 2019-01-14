<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#input" role="tab">
                        <span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down"><i class="mdi mdi-pencil"></i> Input</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#list" role="tab">
                        <span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down"><i class="mdi mdi-format-list-bulleted"></i> List</span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content tabcontent-border">
                <div class="tab-pane active" id="input" role="tabpanel">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Input Data <?php echo $title ?></h4>
                                    <div class="form-group row">
                                        <label for="i-nama" 
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Nama
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="i-nama" placeholder="Nama Tempat Latihan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-alamat"
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Alamat
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea id="i-alamat" class="form-control" placeholder="Alamat Tempat Latihan"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-lat"
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Latitude
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="i-lat" placeholder="##.####">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-lng"
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Longitude
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="i-lng" placeholder="##.####">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="button" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="list" role="tabpanel">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Daftar <?php echo $title ?></h4>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>Mulhadi</td>
                                        <td>Papringan Utara</td>
                                        <td>7.2312</td>
                                        <td>-12.3141</td>
                                        <td>
                                            <button type="button" class="btn btn-default">Ubah</button>
                                            <button type="button" class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>