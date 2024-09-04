
<br>
<style>
    .mycol{
        background-color: #ffffff !important;
    }
</style>
</div>
<center>
        <div class="col-sm-9 col-md-8 bg-light p-2">
            <table class="table  table-borderless border-primary mycol">
                <tr><th>Full Name:</th><td><?=esc($row->firstname)?> <?=esc($row->lastname)?></td></tr>
                
                <tr><th>Email:</th><td><?=esc($row->email)?></td></tr>
                <tr><th>Gender:</th><td><?=esc($row->gender)?></td></tr>
                
                <!-- <tr><th>Rank:</th><td><?//=ucwords(str_replace("_"," ",$row->rank))?></td></tr> -->
              
            </table>
        </div>
        </center>
    </div>
   