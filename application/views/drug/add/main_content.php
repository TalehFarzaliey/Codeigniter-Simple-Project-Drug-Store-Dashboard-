<!-- Git için Test -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url("drug/add");?>">


                    <div class="box-body col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Başlıq</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="box-body col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Açıqlama</label>
                                <textarea id="detail" name="detail" rows="10" cols="80"></textarea>
                        </div>
                    </div>

                    <div class="clearfix"></div>


                    <div class="box-body col-md-6">
                        <div class="form-group">
                            <label>Kategoriya</label>
                            <select class="form-control" name="drug_type_id">
                                <?php foreach (get_drug_category(array("isActive" => 1)) as $category){ ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="clearfix"></div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Əlavə et</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
</section>
<!-- /.content -->