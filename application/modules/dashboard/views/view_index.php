<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
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
                            <p class="mb-0 mt-2" style="font-size: 12px;">Rendering Video</p>
                            <p style="font-size: 14px; font-weight: bold"><?= $rendering ?></p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card-box widget-chart-one" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <div class="float-left">
                            <img src="<?= base_url("assets") ?>/images/icon/icon-3.png" alt="" width="60" style="border-radius: 30px">
                        </div>
                        <div class="widget-chart-one-content">
                            <p class="mb-0 mt-2" style="font-size: 12px;">Template Video</p>
                            <p style="font-size: 14px; font-weight: bold"><?= $template ?></p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card-box widget-chart-one" style="box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5)">
                        <div class="float-left">
                            <img src="<?= base_url("assets") ?>/images/icon/icon-4.png" alt="" width="60" style="border-radius: 30px">
                        </div>
                        <div class="widget-chart-one-content">
                            <p class="mb-0 mt-2" style="font-size: 12px;">Quota rendering video</p>
                            <p class="text-danger" style="font-weight: bold">Unlimited</p>
                        </div>

                    </div>
                </div>             
            </div>
            <div class="row">

                <div class="col-lg-7">

                    <div class="card-box">
                        <h4 class="header-title">Video views</h4>

                        <canvas id="myChart" width="200" height="200"></canvas>


                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card-custom">
                        <div class="card-box" style="background-color: orange;height: 200px;">
                            
                        </div>
                        <div class="card-box text-center">
                            <div class="img-profile">
                                <img src="<?= base_url("assets/images/users/".$this->session->userdata('foto')) ?>" alt="" width="120" style="border-radius: 60px; border: 7px solid #fff;">
                            </div>
                            <div class="">
                                <h4 class="m-b-5"><?= $this->session->userdata('username') ?></h4>
                                <p class="text-muted"><?= $this->session->userdata('level') ?></p>
                            </div>

                            <ul class="social-links list-inline m-t-20">
                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>

                            <div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        Maintenance
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="checkbox" id="send_notif" <?php if ($status_server->status == 1) { echo "checked"; }?> data-plugin="switchery" data-color="#f1b53d"/>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>