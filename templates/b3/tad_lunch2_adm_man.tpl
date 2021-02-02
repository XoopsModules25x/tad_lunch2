<link href="<{$xoops_url}>/modules/tadtools/css/font-awesome/css/font-awesome.css" rel="stylesheet">
<div class="container-fluid">
  <script type="text/javascript" src="<{$xoops_url}>/modules/tad_lunch2/class/tmt_core.js"></script>
  <script type="text/javascript" src="<{$xoops_url}>/modules/tad_lunch2/class/tmt_spry_linkedselect.js"></script>

  <script type="text/javascript">
    function getOptions()
    {

      var values = [];
      var sel = document.getElementById('destination');
      for (var i=0, n=sel.options.length;i<n;i++) {
        if (sel.options[i].value) values.push(sel.options[i].value);
      }
      document.getElementById('tad_lunch2_man_arr').value=values.join(',');
    }
  </script>

  <form action="man.php" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">

    <div class="form-group">
      <div class="col-sm-5">
        <h3><{$smarty.const._MA_TADLUNCH2_LUNCH_USER}></h3>
        <select id="repository" size="12" multiple="multiple" tmt:linkedselect="true" class="form-control" style="height: 200px;">
          <{if $repository}>
            <{foreach from=$repository item=opt}>
              <option value="<{$opt.uid}>"><{$opt.name}> (<{$opt.email}>)</option>
            <{/foreach}>
          <{/if}>
        </select>

      </div>
      <div class="col-sm-1 text-center">
        <img src="<{$xoops_url}>/modules/tad_lunch2/images/right.png" onclick="tmt.spry.linkedselect.util.moveOptions('repository', 'destination'); getOptions();" alt="right"><br>
        <img src="<{$xoops_url}>/modules/tad_lunch2/images/left.png" onclick="tmt.spry.linkedselect.util.moveOptions('destination' , 'repository'); getOptions();" alt="left"><br><br>

        <!--img src="<{$xoops_url}>/modules/tad_lunch2/images/up.png" onclick="tmt.spry.linkedselect.util.moveOptionUp('destination'); getOptions();" alt="up"><br>
        <img src="<{$xoops_url}>/modules/tad_lunch2/images/down.png" onclick="tmt.spry.linkedselect.util.moveOptionDown('destination'); getOptions();" alt="down"><br><br-->

        <input type='hidden' name='tad_lunch2_man_arr' id='tad_lunch2_man_arr' value='<{$tad_lunch2_man_arr}>'>
        <input type="hidden" name="op" value="save_tad_lunch2_mem">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
      </div>
      <div class="col-sm-5">
        <h3><{$smarty.const._MA_TADLUNCH2_LUNCH_MANAGER}></h3>
        <select id="destination" size="12" multiple="multiple" tmt:linkedselect="true" class="form-control" style="height: 200px;">
          <{if $destination}>
            <{foreach from=$destination item=opt}>
              <option value="<{$opt.uid}>"><{$opt.name}> (<{$opt.email}>)</option>
            <{/foreach}>
          <{/if}>
        </select>
      </div>
    </div>

  </form>
</div>