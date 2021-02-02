<link href="<{$xoops_url}>/modules/tadtools/css/font-awesome/css/font-awesome.css" rel="stylesheet">
<div class="container-fluid">

  <!--顯示表單-->
  <{if $now_op=="tad_lunch2_form"}>
    <form action="<{$action}>" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
      <!--菜單名稱-->
      <div class="form-group">
        <label class="col-sm-2 control-label">
          <{$smarty.const._MA_TADLUNCH2_LUNCH_TITLE}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="lunch_title" id="lunch_title" class="form-control validate[required]" value="<{$lunch_title}>" placeholder="<{$smarty.const._MA_TADLUNCH2_LUNCH_TITLE}>">
        </div>
      </div>

      <!--廠商名稱-->
      <div class="form-group">
        <label class="col-sm-2 control-label">
          <{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="lunch_factory" id="lunch_factory" class="form-control" value="<{$lunch_factory}>" placeholder="<{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY}>">
        </div>
      </div>

      <!--營養師-->
      <div class="form-group">
        <label class="col-sm-2 control-label">
          <{$smarty.const._MA_TADLUNCH2_LUNCH_DIETICIAN}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="lunch_dietician" id="lunch_dietician" class="form-control" value="<{$lunch_dietician}>" placeholder="<{$smarty.const._MA_TADLUNCH2_LUNCH_DIETICIAN}>">
        </div>
      </div>

      <!--廠商電話-->
      <div class="form-group">
        <label class="col-sm-2 control-label">
          <{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_TEL}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="lunch_factory_tel" id="lunch_factory_tel" class="form-control" value="<{$lunch_factory_tel}>" placeholder="<{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_TEL}>">
        </div>
      </div>


      <!--廠商傳真-->
      <div class="form-group">
        <label class="col-sm-2 control-label">
          <{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_FAX}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="lunch_factory_fax" id="lunch_factory_fax" class="form-control" value="<{$lunch_factory_fax}>" placeholder="<{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_FAX}>">
        </div>
      </div>


      <!--廠商地址-->
      <div class="form-group">
        <label class="col-sm-2 control-label">
          <{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_ADDR}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="lunch_factory_addr" id="lunch_factory_addr" class="form-control" value="<{$lunch_factory_addr}>" placeholder="<{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_ADDR}>">
        </div>
      </div>

      <div class="text-center">
        <!--編號-->
        <input type='hidden' name="lunch_sn" value="<{$lunch_sn}>">
        <input type="hidden" name="op" value="<{$next_op}>">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
      </div>
    </form>
  <{/if}>


  <!--列出所有資料-->
  <{if $all_content}>
    <{if $isAdmin}>
      <script type="text/javascript">
      function delete_tad_lunch2_func(lunch_sn){
        var sure = window.confirm("<{$smarty.const._TAD_DEL_CONFIRM}>");
        if (!sure)  return;
        location.href="<{$action}>?op=delete_tad_lunch2&lunch_sn=" + lunch_sn;
      }
      </script>
    <{/if}>

    <table class="table table-striped table-hover">
      <thead>
      <tr>
        <th><!--菜單名稱--><{$smarty.const._MA_TADLUNCH2_LUNCH_TITLE}></th>
        <th><!--廠商名稱--><{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY}></th>
        <th><!--營養師--><{$smarty.const._MA_TADLUNCH2_LUNCH_DIETICIAN}></th>
        <th><!--廠商電話--><{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_TEL}></th>
        <th><!--廠商傳真--><{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_FAX}></th>
        <th><!--廠商地址--><{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_ADDR}></th>
        <{if $isAdmin}>
          <th><{$smarty.const._TAD_FUNCTION}></th>
        <{/if}>
      </tr>
      </thead>

      <tbody>
      <{foreach from=$all_content item=data}>
        <tr>
          <td><{$data.lunch_title}></td>
          <td><{$data.lunch_factory}></td>
          <td><{$data.lunch_dietician}></td>
          <td><{$data.lunch_factory_tel}></td>
          <td><{$data.lunch_factory_fax}></td>
          <td><{$data.lunch_factory_addr}></td>
          <{if $isAdmin}>
          <td>
            <a href="javascript:delete_tad_lunch2_func(<{$data.lunch_sn}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
            <a href="<{$action}>?op=tad_lunch2_form&lunch_sn=<{$data.lunch_sn}>" class="btn btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
          </td>
          <{/if}>
        </tr>
      <{/foreach}>
      </tbody>
    </table>


    <{if $isAdmin}>
      <div class="text-right">
        <a href="<{$action}>?op=tad_lunch2_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
      </div>
    <{/if}>

    <{$bar}>
  <{elseif $now_op=="list_tad_lunch2"}>
    <div class="jumbotron">
      <{if $isAdmin}>
        <a href="<{$action}>?op=tad_lunch2_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
      <{/if}>
    </div>
  <{/if}>

  <!--顯示某一筆資料-->
  <{if $now_op=="show_one_tad_lunch2"}>
    <h2 class="text-center"><{$title}></h2>
    <hr>

    <div class="row">
        <!--廠商名稱-->
      <div class="col-sm-3 text-right">
        <{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY}>
      </div>
      <div class="col-sm-9">
        <{$lunch_factory}>
      </div>
    </div>

    <div class="row">
      <!--營養師-->
      <div class="col-sm-3 text-right">
        <{$smarty.const._MA_TADLUNCH2_LUNCH_DIETICIAN}>
      </div>
      <div class="col-sm-9">
        <{$lunch_dietician}>
      </div>
    </div>

    <div class="row">
      <!--廠商電話-->
      <div class="col-sm-3 text-right">
        <{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_TEL}>
      </div>
      <div class="col-sm-9">
        <{$lunch_factory_tel}>
      </div>
    </div>

    <div class="row">
      <!--廠商傳真-->
      <div class="col-sm-3 text-right">
        <{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_FAX}>
      </div>
      <div class="col-sm-9">
        <{$lunch_factory_fax}>
      </div>
    </div>

    <div class="row">
      <!--廠商地址-->
      <div class="col-sm-3 text-right">
        <{$smarty.const._MA_TADLUNCH2_LUNCH_FACTORY_ADDR}>
      </div>
      <div class="col-sm-9">
        <{$lunch_factory_addr}>
      </div>
    </div>

  <{/if}>

</div>