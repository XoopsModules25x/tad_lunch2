<{$toolbar}>

<!--顯示表單-->
<script type="text/javascript" src="<{$xoops_url}>/modules/tadtools/My97DatePicker/WdatePicker.js"></script>

<{if $now_op=="tad_lunch2_data_form"}>
  <link rel="stylesheet" type="text/css" href="<{$xoops_url}>/modules/tad_lunch2/class/jquery-combobox/css/jquery.combobox/style.css">
  <script type="text/javascript" src="<{$xoops_url}>/modules/tad_lunch2/class/jquery-combobox/js/jquery.combobox.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
    <{if $main_food_source!="''"}>$('#main_food').combobox([<{$main_food_source}>]);<{/if}>
    <{if $main_dish_source!="''"}>$('#main_dish').combobox([<{$main_dish_source}>]);<{/if}>
    <{if $side_dish1_source!="''"}>$('#side_dish1').combobox([<{$side_dish1_source}>]);<{/if}>
    <{if $side_dish2_source!="''"}>$('#side_dish2').combobox([<{$side_dish2_source}>]);<{/if}>
    <{if $side_dish3_source!="''"}>$('#side_dish3').combobox([<{$side_dish3_source}>]);<{/if}>
    <{if $fruit_source!="''"}>$('#fruit').combobox([<{$fruit_source}>]);<{/if}>
    <{if $soup_source!="''"}>$('#soup').combobox([<{$soup_source}>]);<{/if}>

    $('#main_food').change(function(){
      $.post("get_stuff.php", { op: "get_stuff",  col: "main_food", val: $('#main_food').val() },
      function(data) {
        $('#main_food_stuff').val(data);
      });
    });

    $('#main_dish').change(function(){
      $.post("get_stuff.php", { op: "get_stuff",  col: "main_dish", val: $('#main_dish').val() },
      function(data) {
        $('#main_dish_stuff').val(data);
      });
      $.post("get_stuff.php", { op: "get_cook",  col: "main_dish", val: $('#main_dish').val() },
      function(data) {
        $('#main_dish_cook').val(data);
      });
    });

    $('#side_dish1').change(function(){
      $.post("get_stuff.php", { op: "get_stuff",  col: "side_dish1", val: $('#side_dish1').val() },
      function(data) {
        $('#side_dish1_stuff').val(data);
      });
      $.post("get_stuff.php", { op: "get_cook",  col: "side_dish1", val: $('#side_dish1').val() },
      function(data) {
        $('#side_dish1_cook').val(data);
      });
    });

    $('#side_dish2').change(function(){
      $.post("get_stuff.php", { op: "get_stuff",  col: "side_dish2", val: $('#side_dish2').val() },
      function(data) {
        $('#side_dish2_stuff').val(data);
      });
      $.post("get_stuff.php", { op: "get_cook",  col: "side_dish2", val: $('#side_dish2').val() },
      function(data) {
        $('#side_dish2_cook').val(data);
      });
    });

    $('#side_dish3').change(function(){
      $.post("get_stuff.php", { op: "get_stuff",  col: "side_dish3", val: $('#side_dish3').val() },
      function(data) {
        $('#side_dish3_stuff').val(data);
      });
      $.post("get_stuff.php", { op: "get_cook",  col: "side_dish3", val: $('#side_dish3').val() },
      function(data) {
        $('#side_dish3_cook').val(data);
      });
    });

    $('#fruit').change(function(){
      $.post("get_stuff.php", { op: "get_stuff",  col: "fruit", val: $('#fruit').val() },
      function(data) {
        $('#fruit_stuff').val(data);
      });
    });

    $('#soup').change(function(){
      $.post("get_stuff.php", { op: "get_stuff",  col: "soup", val: $('#soup').val() },
      function(data) {
        $('#soup_stuff').val(data);
      });
      $.post("get_stuff.php", { op: "get_cook",  col: "soup", val: $('#soup').val() },
      function(data) {
        $('#soup_cook').val(data);
      });
    });
  });
  </script>

  <h1><{$lunch_date}><{$smarty.const._MD_TAD_LUNCH2_DATA_FORM}></h1>
  <form action="<{$action}>" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">

    <div class="form-group">
      <!--日期-->
      <label class="col-sm-2 control-label">
        <{$smarty.const._MD_TADLUNCH2_LUNCH_DATE}>
      </label>
      <div class="col-sm-2">
        <input type="text" name="lunch_date" id="lunch_date" class="form-control validate[required]" value="<{$lunch_date}>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd' , startDate:'%y-%M-%d'})" onkeypress="WdatePicker({dateFmt:'yyyy-MM-dd' , startDate:'%y-%M-%d'})"placeholder="<{$smarty.const._MD_TADLUNCH2_LUNCH_DATE}>">
      </div>

      <!--供餐來源-->
      <label class="col-sm-2 control-label">
        <{$smarty.const._MD_TADLUNCH2_LUNCH_TARGET}>
      </label>
      <div class="col-sm-2">
        <select name="lunch_target" class="form-control" size=1>
          <{foreach from=$lunch_target_menu item=target}>
            <option value="<{$target.title}>" <{if $lunch_target == $target.title}>selected="selected"<{/if}>><{$target.title}></option>
          <{/foreach}>
        </select>
      </div>

      <!--廠商-->
      <label class="col-sm-2 control-label">
        <{$smarty.const._MD_TADLUNCH2_LUNCH_SN}>
      </label>
      <div class="col-sm-2">
        <select name="lunch_sn" class="form-control" size=1>
          <{foreach from=$lunch_company item=lunch}>
            <option value="<{$lunch.lunch_sn}>" <{if $lunch_sn == $lunch.lunch_sn}>selected="selected"<{/if}>><{$lunch.lunch_title}></option>
          <{/foreach}>
        </select>
      </div>
    </div>


    <div class="well">
      <!--標題-->
      <div class="row">
        <label class="col-sm-1">
          <{$smarty.const._MD_TADLUNCH2_KIND}>
        </label>
        <label class="col-sm-4">
          <{$smarty.const._MD_TADLUNCH2_FOOD}>
        </label>

        <label class="col-sm-5">
          <{$smarty.const._MD_TADLUNCH2_FOOD_STUFF}>
        </label>

        <label class="col-sm-2">
          <{$smarty.const._MD_TADLUNCH2_COOK}>
        </label>
      </div>

      <!--主食-->
      <div class="form-group">
        <label class="col-sm-1 control-label">
          <{$smarty.const._MD_TADLUNCH2_MDIN_FOOD}>
        </label>
        <div class="col-sm-4">
          <input type="text" name="main_food"  id="main_food" class="form-control validate[required , minSize[1] , maxSize[255]]" value="<{$main_food}>" placeholder="<{$smarty.const._MD_TADLUNCH2_MDIN_FOOD}>">
        </div>
        <div class="col-sm-5">
          <input type="text" name="main_food_stuff" id="main_food_stuff" class="form-control " value="<{$main_food_stuff}>" placeholder="<{$smarty.const._MD_TADLUNCH2_MDIN_FOOD_STUFF}>">
        </div>
      </div>

      <!--主菜-->
      <div class="form-group">
        <label class="col-sm-1 control-label">
          <{$smarty.const._MD_TADLUNCH2_MDIN_DISH}>
        </label>
        <div class="col-sm-4">
          <input type="text" name="main_dish" id="main_dish" class="form-control validate[required , minSize[1] , maxSize[255]]" value="<{$main_dish}>" placeholder="<{$smarty.const._MD_TADLUNCH2_MDIN_DISH}>">
        </div>
        <div class="col-sm-5">
          <input type="text" name="main_dish_stuff" id="main_dish_stuff" class="form-control" value="<{$main_dish_stuff}>" placeholder="<{$smarty.const._MD_TADLUNCH2_MDIN_DISH_STUFF}>">
        </div>
        <div class="col-sm-2">
          <input type="text" name="main_dish_cook" id="main_dish_cook" class="form-control" value="<{$main_dish_cook}>" placeholder="<{$smarty.const._MD_TADLUNCH2_MDIN_DISH_COOK}>">
        </div>
      </div>

      <!--副菜1-->
      <div class="form-group">
        <label class="col-sm-1 control-label">
          <{$smarty.const._MD_TADLUNCH2_SIDE_DISH1}>
        </label>
        <div class="col-sm-4">
          <input type="text" name="side_dish1" id="side_dish1" class="form-control" value="<{$side_dish1}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SIDE_DISH1}>">
        </div>
        <div class="col-sm-5">
          <input type="text" name="side_dish1_stuff" id="side_dish1_stuff" class="form-control" value="<{$side_dish1_stuff}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SIDE_DISH1_STUFF}>">
        </div>
        <div class="col-sm-2">
          <input type="text" name="side_dish1_cook" id="side_dish1_cook" class="form-control" value="<{$side_dish1_cook}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SIDE_DISH1_COOK}>">
        </div>
      </div>


      <!--副菜2-->
      <div class="form-group">
        <label class="col-sm-1 control-label">
          <{$smarty.const._MD_TADLUNCH2_SIDE_DISH2}>
        </label>
        <div class="col-sm-4">
          <input type="text" name="side_dish2" id="side_dish2" class="form-control" value="<{$side_dish2}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SIDE_DISH2}>">
        </div>
        <div class="col-sm-5">
          <input type="text" name="side_dish2_stuff" id="side_dish2_stuff" class="form-control" value="<{$side_dish2_stuff}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SIDE_DISH2_STUFF}>">
        </div>
        <div class="col-sm-2">
          <input type="text" name="side_dish2_cook" id="side_dish2_cook" class="form-control" value="<{$side_dish2_cook}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SIDE_DISH2_COOK}>">
        </div>
      </div>


      <!--副菜3-->
      <div class="form-group">
        <label class="col-sm-1 control-label">
          <{$smarty.const._MD_TADLUNCH2_SIDE_DISH3}>
        </label>
        <div class="col-sm-4">
          <input type="text" name="side_dish3" id="side_dish3" class="form-control" value="<{$side_dish3}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SIDE_DISH3}>">
        </div>
        <div class="col-sm-5">
          <input type="text" name="side_dish3_stuff" id="side_dish3_stuff" class="form-control" value="<{$side_dish3_stuff}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SIDE_DISH3_STUFF}>">
        </div>
        <div class="col-sm-2">
          <input type="text" name="side_dish3_cook" id="side_dish3_cook" class="form-control" value="<{$side_dish3_cook}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SIDE_DISH3_COOK}>">
        </div>
      </div>


      <!--水果-->
      <div class="form-group">
        <label class="col-sm-1 control-label">
          <{$smarty.const._MD_TADLUNCH2_FRUIT}>
        </label>
        <div class="col-sm-4">
          <input type="text" name="fruit" id="fruit" class="form-control" value="<{$fruit}>" placeholder="<{$smarty.const._MD_TADLUNCH2_FRUIT}>">
        </div>
      </div>


      <!--湯點-->
      <div class="form-group">
        <label class="col-sm-1 control-label">
          <{$smarty.const._MD_TADLUNCH2_SOUP}>
        </label>
        <div class="col-sm-4">
          <input type="text" name="soup" id="soup" class="form-control" value="<{$soup}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SOUP}>">
        </div>
        <div class="col-sm-5">
          <input type="text" name="soup_stuff" id="soup_stuff" class="form-control" value="<{$soup_stuff}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SOUP_STUFF}>">
        </div>
        <div class="col-sm-2">
          <input type="text" name="soup_cook" id="soup_cook" class="form-control" value="<{$soup_cook}>" placeholder="<{$smarty.const._MD_TADLUNCH2_SOUP_COOK}>">
        </div>
      </div>
    </div>

    <div class="row">
      <!--蛋白質-->
      <div class="col-sm-3">
        <div class="input-group">
          <span class="input-group-addon"><{$smarty.const._MD_TADLUNCH2_PROTEIN}></span>
          <input type="text" name="protein" id="protein" class="form-control" value="<{$protein}>" placeholder="<{$smarty.const._MD_TADLUNCH2_PROTEIN}>">
          <span class="input-group-addon">g</span>
        </div>
      </div>

      <!--脂肪-->
      <div class="col-sm-3">
        <div class="input-group">
          <span class="input-group-addon"><{$smarty.const._MD_TADLUNCH2_FAT}></span>
          <input type="text" name="fat" id="fat" class="form-control" value="<{$fat}>" placeholder="<{$smarty.const._MD_TADLUNCH2_FAT}>">
          <span class="input-group-addon">g</span>
        </div>
      </div>

      <!--醣類-->
      <div class="col-sm-3">
        <div class="input-group">
          <span class="input-group-addon"><{$smarty.const._MD_TADLUNCH2_CARBOHYDRATE}></span>
          <input type="text" name="carbohydrate" id="carbohydrate" class="form-control" value="<{$carbohydrate}>" placeholder="<{$smarty.const._MD_TADLUNCH2_CARBOHYDRATE}>">
          <span class="input-group-addon">g</span>
        </div>
      </div>

      <!--總熱量-->
      <div class="col-sm-3">
        <div class="input-group">
          <span class="input-group-addon"><{$smarty.const._MD_TADLUNCH2_CALORIE}></span>
          <input type="text" name="calorie" id="calorie" class="form-control" value="<{$calorie}>" placeholder="<{$smarty.const._MD_TADLUNCH2_CALORIE}>">
          <span class="input-group-addon">g</span>
        </div>
      </div>
    </div>

    <div class="alert alert-info" style="margin-top: 10px;">
      <div class="form-group">
        <label class="col-sm-3 control-label">
          <{$smarty.const._MD_TADLUNCH2_UPLOADPIC}>
        </label>
        <div class="col-sm-7">
          <{$upform}>
        </div>
        <div class="col-sm-2 text-right">
          <input type="hidden" name="lunch_data_sn" value="<{$lunch_data_sn}>">
          <input type="hidden" name="op" value="<{$next_op}>">
          <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
        </div>
      </div>
    </div>

  </form>

  <hr>
  <h3><{$smarty.const._MD_TAD_LUNCH2_DATA_IMPORT}></h3>
  <form action="index.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
    <div class="controls">
      <!--供餐來源-->
      <div class="form-group">
        <label class="col-sm-2 control-label">
          <{$smarty.const._MD_TADLUNCH2_LUNCH_TARGET}>
        </label>
        <div class="col-sm-4">
          <select name="lunch_target" class="form-control" size=1>
            <{foreach from=$lunch_target_menu item=target}>
            <option value="<{$target.title}>" <{if $lunch_target == $target.title}>selected="selected"<{/if}>><{$target.title}></option>
            <{/foreach}>
          </select>
        </div>
        <!--廠商-->
        <label class="col-sm-2 control-label">
          <{$smarty.const._MD_TADLUNCH2_LUNCH_SN}>
        </label>
        <div class="col-sm-4">
        <select name="lunch_sn" class="form-control" size=1>
          <{foreach from=$lunch_company item=lunch}>
          <option value="<{$lunch.lunch_sn}>" <{if $lunch_sn == $lunch.lunch_sn}>selected="selected"<{/if}>><{$lunch.lunch_title}></option>
          <{/foreach}>
        </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">
        <{$smarty.const._MD_TAD_LUNCH2_DATA_IMPORT_FILE}>
      </label>
      <div class="col-sm-4">
        <input type="file" name="importfile">
      </div>
      <div class="col-sm-6">
        <div class="help-block">
          <input type="hidden" name="op" value="import_excel">
          <button type="submit" class="btn btn-primary"><{$smarty.const._MD_TAD_LUNCH2_DATA_IMPORT}></button>
          <{$smarty.const._MD_TAD_LUNCH2_DATA_IMPORT_FILE_DESC}>
        </div>
      </div>
    </div>
  </form>

<{/if}>


<!--列出所有資料-->
<{if $now_op=="list_tad_lunch2_data"}>

  <link rel="stylesheet" type="text/css" href="class/fullcalendar/redmond/theme.css" />
  <link rel="stylesheet" type="text/css" href="class/fullcalendar/fullcalendar.css">
  <script src="class/fullcalendar/fullcalendar.js" type="text/javascript"></script>
  <style type="text/css" media="screen">
    .fc-event {
      border:none; /* default BORDER color */
      background-color: transparent; /* default BACKGROUND color */
      color: #000000;               /* default TEXT color */
      font-size: 0.8em;
      cursor: default;
    }

    .fc-event-title{
      font-size: 0.8em;
      line-height: 120%;
      padding: 0px 1px;
      color: #000000;
    }
  </style>

  <script type="text/javascript">
  $(document).ready(function(){
    $("#lunch2_calendar").fullCalendar({
      header: { left:"today", center:"title", right:" prev,next" } ,
      buttonText:{today:"<{$smarty.const._MD_TADLUNCH2_TODAY}>",prev:"<{$smarty.const._MD_TADLUNCH2_PRE_MONTH}>",next:"<{$smarty.const._MD_TADLUNCH2_NEXT_MONTH}>"},
      defaultView:"month",
      weekends: true,
      firstDay:1,
      theme:true,
      titleFormat: {
        month: "yyyy<{$smarty.const._MD_TADLUNCH2_Y}>MMM<{$lunch_target}><{$smarty.const._MD_TADLUNCH2}>"
      },
      monthNames: ["<{$smarty.const._MD_TADLUNCH2_MONTH1}>","<{$smarty.const._MD_TADLUNCH2_MONTH2}>","<{$smarty.const._MD_TADLUNCH2_MONTH3}>","<{$smarty.const._MD_TADLUNCH2_MONTH4}>","<{$smarty.const._MD_TADLUNCH2_MONTH5}>","<{$smarty.const._MD_TADLUNCH2_MONTH6}>","<{$smarty.const._MD_TADLUNCH2_MONTH7}>","<{$smarty.const._MD_TADLUNCH2_MONTH8}>","<{$smarty.const._MD_TADLUNCH2_MONTH9}>","<{$smarty.const._MD_TADLUNCH2_MONTH10}>","<{$smarty.const._MD_TADLUNCH2_MONTH11}>","<{$smarty.const._MD_TADLUNCH2_MONTH12}>"],
      monthNamesShort: ["1<{$smarty.const._MD_TADLUNCH2_MONTH}>","2<{$smarty.const._MD_TADLUNCH2_MONTH}>","3<{$smarty.const._MD_TADLUNCH2_MONTH}>","4<{$smarty.const._MD_TADLUNCH2_MONTH}>","5<{$smarty.const._MD_TADLUNCH2_MONTH}>","6<{$smarty.const._MD_TADLUNCH2_MONTH}>","7<{$smarty.const._MD_TADLUNCH2_MONTH}>","8<{$smarty.const._MD_TADLUNCH2_MONTH}>","9<{$smarty.const._MD_TADLUNCH2_MONTH}>","10<{$smarty.const._MD_TADLUNCH2_MONTH}>","11<{$smarty.const._MD_TADLUNCH2_MONTH}>","12<{$smarty.const._MD_TADLUNCH2_MONTH}>"],
      dayNames: ["<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_SU}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_MO}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_TU}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_WE}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_TH}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_FR}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_SA}>"],
      dayNamesShort: ["<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_SU}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_MO}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_TU}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_WE}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_TH}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_FR}>","<{$smarty.const._MD_TADLUNCH2_WEEK}><{$smarty.const._MD_TADLUNCH2_SA}>"],

      eventClick: function(calEvent) {
        if (calEvent.rel) {
          $.fancybox({
            'href' : calEvent.rel,
            'type' : 'iframe',
            'fitToView' : true,
            'width'   : '1280',
            'height'    : 'auto',
            'autoSize'  : false,
            'closeClick'  : false,
            'openEffect'  : 'none',
            'closeEffect' : 'none'
          });
          return false;
        }
      },
      events: function(start, end, callback) {
        $.getJSON("get_events.php",
        {
          start: start.getTime(),
          end: end.getTime(),
          // rel: "<{$xoops_url}>",
          lunch_target:"<{$lunch_target}>"
        },
        function(result) {
          callback(result);
        });

      }
    });



    $('#Excel').click(function() {
      var date = $("#lunch2_calendar").fullCalendar('getDate');
      var year = date.getFullYear();
      var month_int = date.getMonth()+1;
      location.href="excel.php?op=dl_excel&ym="+year+"-"+month_int+"&lunch_target=<{$lunch_target}>";
    });

    $('#Word').click(function() {
      var date = $("#lunch2_calendar").fullCalendar('getDate');
      var year = date.getFullYear();
      var month_int = date.getMonth()+1;
      location.href="word.php?op=dl_word&ym="+year+"-"+month_int+"&lunch_target=<{$lunch_target}>";
    });

  });

  </script>

  <div class="row" style="margin: 10px 0px;">
    <div class="col-sm-8">
      <div class="row">
        <div class="col-sm-4">
          <select class="form-control" id="lunch_target" onChange="location.href='index.php?lunch_target=' + this.value">
            <{foreach from=$lunch_target_arr item=target}>
              <option value="<{$target.title}>" <{if $lunch_target==$target.title}>selected<{/if}>>
                <{$target.title}>
              </option>
            <{/foreach}>
          </select>
        </div>
        <div class="col-sm-8">
          <button class="btn btn-primary" id="Excel"><{$smarty.const._MD_TADLUNCH2_DOWNLOAD}>Excel</button>
          <button class="btn btn-primary" id="Word"><{$smarty.const._MD_TADLUNCH2_DOWNLOAD}>Word</button>
        </div>
      </div>
    </div>
    <{if $isAdmin or $isManager}>
      <div class="col-sm-4 text-right">
        <a href="<{$action}>?op=tad_lunch2_data_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
      </div>
    <{/if}>
  </div>

  <div id="lunch2_calendar"></div>



<{/if}>

<!--顯示某一筆資料-->
<{if $now_op=="show_one_tad_lunch2_data"}>

  <{foreach from=$all_data item=all}>

    <div class="row">
      <div class="col-sm-4" style="font-weight:bold;">
       <{$title}>
      </div>

      <div class="col-sm-2">
        <span class="label label-success"><{$smarty.const._MD_TADLUNCH2_PROTEIN}></span>
        <{$all.protein}>g
      </div>

      <div class="col-sm-2">
        <span class="label label-warning"><{$smarty.const._MD_TADLUNCH2_FAT}></span>
        <{$all.fat}>g
      </div>

      <div class="col-sm-2">
        <span class="label label-danger"><{$smarty.const._MD_TADLUNCH2_CARBOHYDRATE}></span>
        <{$all.carbohydrate}>g
      </div>

      <div class="col-sm-2">
        <span class="label label-info"><{$smarty.const._MD_TADLUNCH2_CALORIE}></span>
        <{$all.calorie}>g
      </div>

    </div>
    <table class="table table-striped table-bordered table-hover">

      <tr>
        <th style="text-align:center;"><!--廠商--></th>
        <th style="text-align:center;"><!--主食--><{$smarty.const._MD_TADLUNCH2_MDIN_FOOD}></th>
        <th style="text-align:center;"><!--主菜--><{$smarty.const._MD_TADLUNCH2_MDIN_DISH}></th>
        <th style="text-align:center;"><!--副菜1--><{$smarty.const._MD_TADLUNCH2_SIDE_DISH1}></th>
        <th style="text-align:center;"><!--副菜2--><{$smarty.const._MD_TADLUNCH2_SIDE_DISH2}></th>
        <th style="text-align:center;"><!--副菜3--><{$smarty.const._MD_TADLUNCH2_SIDE_DISH3}></th>
        <th style="text-align:center;"><!--水果--><{$smarty.const._MD_TADLUNCH2_FRUIT}></th>
        <th style="text-align:center;"><!--湯點--><{$smarty.const._MD_TADLUNCH2_SOUP}></th>
      </tr>
      <tr>
        <th style="text-align:center;"><{$smarty.const._MD_TADLUNCH2_FOOD}></th>
        <td style="text-align:center;"><{$all.main_food}></td>
        <td style="text-align:center;"><{$all.main_dish}></td>
        <td style="text-align:center;"><{$all.side_dish1}></td>
        <td style="text-align:center;"><{$all.side_dish2}></td>
        <td style="text-align:center;"><{$all.side_dish3}></td>
        <td style="text-align:center;"><{$all.fruit}></td>
        <td style="text-align:center;"><{$all.soup}></td>
      </tr>
      <tr>
        <th style="text-align:center;"><{$smarty.const._MD_TADLUNCH2_FOOD_STUFF_SHORT}></th>
        <td style="text-align:center;"><{$all.main_food_stuff}></td>
        <td style="text-align:center;"><{$all.main_dish_stuff}></td>
        <td style="text-align:center;"><{$all.side_dish1_stuff}></td>
        <td style="text-align:center;"><{$all.side_dish2_stuff}></td>
        <td style="text-align:center;"><{$all.side_dish3_stuff}></td>
        <td></td>
        <td style="text-align:center;"><{$all.soup_stuff}></td>
      </tr>
      <tr>
        <th style="text-align:center;"><{$smarty.const._MD_TADLUNCH2_COOK_SHORT}></th>
        <td style="text-align:center;"><{$all.main_food_cook}></td>
        <td style="text-align:center;"><{$all.main_dish_cook}></td>
        <td style="text-align:center;"><{$all.side_dish1_cook}></td>
        <td style="text-align:center;"><{$all.side_dish2_cook}></td>
        <td style="text-align:center;"><{$all.side_dish3_cook}></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"><{$all.soup_cook}></td>
      </tr>
    </table>

    <hr>
  <{/foreach}>
<{/if}>



<{if $now_op=="import_excel"}>
  <form action="<{$action}>" method="post" id="myForm" enctype="multipart/form-data">
    <input type="hidden" name="lunch_sn" value="<{$lunch_sn}>">
    <input type="hidden" name="lunch_target" value="<{$lunch_target}>">
    <input type="hidden" name="op" value="import2DB">
    <h3><{$lunch_target}></h3>
    <table class="table table-striped table-bordered table-hover">
      <{$main}>
    </table>
    <div class="text-align:center;">
    <button type="submit" class="btn btn-primary"><{$smarty.const._MD_TAD_LUNCH2_DATA_IMPORT}></button>
  </div>
  </form>
<{/if}>