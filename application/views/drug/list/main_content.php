<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo  base_url("drug/newPage");?>" class="btn btn-sm btn-primary mb10"><i class="fa fa-plus"></i> Elave et</a>
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Ad</th>
                            <th>Kategoriya</th>
                            <th>isActive</th>
                            <th class="col-md-2">Emeliyyatlar</th>
                        </thead>
                        <tbody class="sortableList" postUrl="drug/rankUpdate">
                            <?php foreach($rows as $row) { ?>
                                <tr id="sortId-<?php echo $row->id;?>">
                                    <td><?php echo $row->id;?></td>
                                    <td><?php echo $row->name;?></td>
                                    <td><?php echo $row->category;?></td>
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
                                        >
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url("drug/editPage/$row->id");?>">
                                            <i class="fa fa-edit" style="font-size:16px;"></i>
                                        </a> |
                                        <a class="removeBtn"  dataURL="<?php echo base_url("drug/delete/$row->id"); ?>">
                                            <i class="fa fa-trash" style="font-size:16px;"></i>
                                        </a> |

                                        <a href="<?php echo base_url("drug/imageUploadPage/$row->id"); ?>">
                                            <i class="fa fa-image" style="font-size:16px;"></i>
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