<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card-box widget-chart-one" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <div class="float-left">
                            <img src="<?= base_url("assets") ?>/images/icon/facebook.png" alt="" width="60" style="border-radius: 30px">
                        </div>
                        <div class="widget-chart-one-content">
                            <p class="mb-0 mt-2" style="font-size: 12px;">Facebok</p>
                            <p style="font-size: 14px; font-weight: bold"><?= $facebook->fb_share ?></p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card-box widget-chart-one" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <div class="float-left">
                            <img src="<?= base_url("assets") ?>/images/icon/twitter.png" alt="" width="60" style="border-radius: 30px">
                        </div>
                        <div class="widget-chart-one-content">
                            <p class="mb-0 mt-2" style="font-size: 12px;">Twitter</p>
                            <p style="font-size: 14px; font-weight: bold"><?= $twitter->twitter_share ?></p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card-box widget-chart-one" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <div class="float-left">
                            <img src="<?= base_url("assets") ?>/images/icon/youtube.png" alt="" width="60" style="border-radius: 30px">
                        </div>
                        <div class="widget-chart-one-content">
                            <p class="mb-0 mt-2" style="font-size: 12px;">Youtube</p>
                            <p style="font-size: 14px; font-weight: bold"><?= $youtube->yt_share ?></p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card-box widget-chart-one" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <div class="float-left">
                            <img src="<?= base_url("assets") ?>/images/icon/instagram.png" alt="" width="60" style="border-radius: 30px">
                        </div>
                        <div class="widget-chart-one-content">
                            <p class="mb-0 mt-2" style="font-size: 12px;">Instagram</p>
                            <p style="font-weight: bold"><?= $instagram->ig_share ?></p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card-box widget-chart-one" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <div class="float-left">
                            <img src="<?= base_url("assets") ?>/images/icon/wa.png" alt="" width="60" style="border-radius: 30px">
                        </div>
                        <div class="widget-chart-one-content">
                            <p class="mb-0 mt-2" style="font-size: 12px;">Whatsapp</p>
                            <p style="font-size: 14px; font-weight: bold"><?= $wa->wa_share ?></p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card-box widget-chart-one" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <div class="float-left">
                            <img src="<?= base_url("assets") ?>/images/icon/linkedin.png" alt="" width="60" style="border-radius: 30px">
                        </div>
                        <div class="widget-chart-one-content">
                            <p class="mb-0 mt-2" style="font-size: 12px;">Linkedin</p>
                            <p style="font-size: 14px; font-weight: bold"><?= $linkedin->linkedin_share ?></p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card-box widget-chart-one" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <div class="float-left">
                            <img src="<?= base_url("assets") ?>/images/icon/icon-1.png" alt="" width="60" style="border-radius: 30px">
                        </div>
                        <div class="widget-chart-one-content">
                            <p class="mb-0 mt-2" style="font-size: 12px;">Total Users</p>
                            <p style="font-size: 14px; font-weight: bold"><?= $total_user ?></p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card-box widget-chart-one" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <div class="float-left">
                            <img src="<?= base_url("assets") ?>/images/icon/icon-2.png" alt="" width="60" style="border-radius: 30px">
                        </div>
                        <div class="widget-chart-one-content">
                            <p class="mb-0 mt-2" style="font-size: 12px;">Rendering video</p>
                            <p style="font-size: 14px; font-weight: bold"><?= $rendering ?></p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="margin-bottom: 10px;">
                    <a href="<?= base_url('report/export_excel') ?>" class="btn btn-primary float-right" style="border-radius: 5px">Export Data</a>
                </div>
            </div>
            <!-- <div class="row">

                <div class="col-lg-6">

                    <div class="card-box">
                        <h4 class="header-title">Video views</h4>

                        <canvas id="myChart" width="200" height="200"></canvas>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title">Video views</h4>

                        <canvas id="myChart2" width="200" height="200"></canvas>

                    </div>
                </div>

            </div> -->

            <div class="row">
                <div class="col-xl-6 col-sm-12">
                    <div class="card-box" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <h4>Template Video</h4>
                        <p>Rendering Video Total: <?= $rendering ?></p>
                        <?php foreach ($render_template as $v) : ?>
                            <div class="progress-report">
                                <span class="font-13"><?= $v['nama'] ?></span>
                                <p class="font-18"><?= $v['total'] ?></p>
                                <div class="progress m-b-20">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= rtrim($v['jumlah'] . '%') ?>" aria-valuenow="<?= $v['total'] ?>" aria-valuemin="0" aria-valuemax="1000"></div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-12">
                    <div class="card-box" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <form>
                            <div class="form-group">
                                <label for="tgl">Cari Berdasarkan Tanggal</label>
                                <div id="datepicker-inline" class=""></div>
                            </div>
                        </form>
                        <table id="datatable-cari-render" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Video</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>