<div class="card">
    <div class="card-header ch-alt">
        <button class="bgm-amber btn btn-default bg btn-float waves-effect waves-circle waves-float" id="add-group"><i class="zmdi zmdi-plus"></i></button>
    </div>

    <table id="groups-grid" class="table table-hover table-vmiddle" data-ajax="true" data-url="<?php echo base_url('groups/loadGrid'); ?>">
        <thead>
            <tr>
                <th data-column-id="id" data-identifier="true" data-order="asc" data-type="numeric">ID</th>
                <th data-column-id="name">Group Name</th>
                <th data-column-id="description">Description</th>
                <th data-align="center" data-header-align="center" data-column-id="actions" data-formatter="actions" data-sortable="false">Actions
                </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
