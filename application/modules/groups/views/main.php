<div class="page-content-wrapper">
    <div class="page-head">
        <div class="container-fluid">
            <div class="page-title">
                <h1><?php echo $pageTitle; ?></h1>
            </div>
            <div class="page-toolbar">
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-content-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light portlet-fit portlet-datatable ">
                            <div class="portlet-body">
                                <div class="table-container">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="btn-group pull-right">
                                                    <button id="add-btn" class="btn sbold green"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="table-container">
                                    <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th width="5%"> No. </th>
                                                <th width="15%"> Name </th>
                                                <th width="200"> Description </th>
                                                <th width="100"> Actions </th>
                                            </tr>
                                            <tr role="row" class="filter">
                                                <td> </td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="name" placeholder="name" /> </td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="description" placeholder="description" /> </td>
                                                <td>
                                                    <div class="margin-bottom-5">
                                                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                            <i class="fa fa-search"></i> Search</button>
                                                    </div>
                                                    <button class="btn btn-sm red btn-outline filter-cancel">
                                                        <i class="fa fa-times"></i> Reset</button>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>