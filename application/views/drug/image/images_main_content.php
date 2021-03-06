
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo base_url("drug/upload_image");?>" class="dropzone">
            </form>
        </div>
    </div>

    <br>

    <div class="row">

        <div class="col-md-12">

            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <th>Önizləmə</th>
                            <th>isActive</th>
                            <th>isCover</th>
                            <th class="col-md-2">Əməliyyatlar</th>
                        </thead>
                        <tbody class="sortableList" postUrl="drug/drugImageRankUpdate">
                        <?php foreach($rows as $row) { ?>
                            <tr id="sortId-<?php echo $row->id;?>">
                                <td>
                                    <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url("uploads") . "/" . $row->image; ?>">
                                        <img
                                            width="80"
                                            src="<?php echo base_url("uploads") . "/" . $row->image; ?>"
                                            alt="<?php echo $row->image; ?>"
                                            class="img-responsive"
                                        />
                                    </a>

                                </td>
                                <td>
                                    <input class = "toggle_check"
                                           data-onstyle="success"
                                           data-size = "mini"
                                           data-on="Aktif"
                                           data-off="Pasif"
                                           data-offstyle="danger"
                                           type="checkbox"
                                           data-toggle="toggle"
                                           dataID="<?php echo $row->id; ?>"
                                        <?php echo ($row->isActive == 1) ? "checked" : ""; ?>
                                    />
                                </td>
                                <td>
                                    <input class = "toggle_check2"
                                           data-onstyle="success"
                                           data-size = "mini"
                                           data-on="Aktif"
                                           data-off="Pasif"
                                           data-offstyle="danger"
                                           type="checkbox"
                                           data-toggle="toggle"
                                           dataID="<?php echo $row->id; ?>"
                                        <?php echo ($row->isCover == 1) ? "checked" : ""; ?>
                                    />
                                </td>
                                <td>
                                    <a href="<?php echo base_url("drug/deleteImage/$row->id"); ?>">
                                        <i class="fa fa-trash" style="font-size:16px;"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

</section>
<!-- /.content -->