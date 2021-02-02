<{if $block.content}>
  <{if $block.type=="vertical"}>
    <table class="table table-striped table-bordered table-hover">
      <thead>
      <tr>
        <th id="lunch_date"><!--日期--><{$smarty.const._MB_TADLUNCH2_LUNCH_DATE}></th>

        <{foreach from=$block.content item=day_data}>
          <{foreach from=$day_data item=data}>
            <th id="<{$data.lunch_date}>" style="text-align:center;">
              <a href="<{$xoops_url}>/modules/tad_lunch2/lunch.php?lunch_data_sn=<{$data.lunch_data_sn}>" class="lunch_block_fancy fancybox.ajax"><{$data.lunch_date}>(<{$data.w}>) <br><{$data.title}></a>
            </th>
          <{/foreach}>
        <{/foreach}>

      </tr>
      </thead>

      <{if "main_food"|in_array:$block.show_cols}>
        <tr>
          <th><!--主食-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/main_food.png" alt="<{$smarty.const._MB_TADLUNCH2_MAIN_FOOD}>">
            <{$smarty.const._MB_TADLUNCH2_MAIN_FOOD}>
          </th>
          <{foreach from=$block.content item=day_data}>
            <{foreach from=$day_data item=data}>
              <td headers="main_food"><{$data.main_food}></td>
            <{/foreach}>
          <{/foreach}>
        </tr>
      <{/if}>

      <{if "main_dish"|in_array:$block.show_cols}>
        <tr>
          <th><!--主菜-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/main_dish.png" alt="<{$smarty.const._MB_TADLUNCH2_MAIN_DISH}>">
            <{$smarty.const._MB_TADLUNCH2_MAIN_DISH}>
          </th>
          <{foreach from=$block.content item=day_data}>
            <{foreach from=$day_data item=data}>
              <td headers="main_dish"><{$data.main_dish}></td>
            <{/foreach}>
          <{/foreach}>
        </tr>
      <{/if}>

      <{if "side_dish1"|in_array:$block.show_cols}>
        <tr>
          <th><!--副菜1-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/side_dish1.png" alt="<{$smarty.const._MB_TADLUNCH2_SIDE_DISH1}>">
            <{$smarty.const._MB_TADLUNCH2_SIDE_DISH1}>
          </th>
          <{foreach from=$block.content item=day_data}>
            <{foreach from=$day_data item=data}>
          <td headers="side_dish1"><{$data.side_dish1}></td>
            <{/foreach}>
          <{/foreach}>
        </tr>
      <{/if}>

      <{if "side_dish2"|in_array:$block.show_cols}>
        <tr>
          <th><!--副菜2-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/side_dish2.png" alt="<{$smarty.const._MB_TADLUNCH2_SIDE_DISH2}>">
            <{$smarty.const._MB_TADLUNCH2_SIDE_DISH2}>
          </th>
          <{foreach from=$block.content item=day_data}>
            <{foreach from=$day_data item=data}>
          <td headers="side_dish2"><{$data.side_dish2}></td>
            <{/foreach}>
          <{/foreach}>
        </tr>
      <{/if}>

      <{if "side_dish3"|in_array:$block.show_cols}>
        <tr>
          <th><!--副菜3-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/side_dish3.png" alt="<{$smarty.const._MB_TADLUNCH2_SIDE_DISH3}>">
            <{$smarty.const._MB_TADLUNCH2_SIDE_DISH3}>
          </th>
          <{foreach from=$block.content item=day_data}>
            <{foreach from=$day_data item=data}>
          <td headers="side_dish3"><{$data.side_dish3}></td>
            <{/foreach}>
          <{/foreach}>
        </tr>
      <{/if}>

      <{if "fruit"|in_array:$block.show_cols}>
        <tr>
          <th><!--水果-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/fruit.png" alt="<{$smarty.const._MB_TADLUNCH2_FRUIT}>">
            <{$smarty.const._MB_TADLUNCH2_FRUIT}>
          </th>
          <{foreach from=$block.content item=day_data}>
            <{foreach from=$day_data item=data}>
          <td headers="fruit"><{$data.fruit}></td>
            <{/foreach}>
          <{/foreach}>
        </tr>
      <{/if}>

      <{if "soup"|in_array:$block.show_cols}>
        <tr>
          <th><!--湯點-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/soup.png" alt="<{$smarty.const._MB_TADLUNCH2_SOUP}>">
            <{$smarty.const._MB_TADLUNCH2_SOUP}>
          </th>
          <{foreach from=$block.content item=day_data}>
            <{foreach from=$day_data item=data}>
          <td headers="soup"><{$data.soup}></td>
            <{/foreach}>
          <{/foreach}>
        </tr>
      <{/if}>

      <{if "calorie"|in_array:$block.show_cols}>
        <tr>
          <th><!--總熱量-->
            <{$smarty.const._MB_TADLUNCH2_CALORIE}>
          </th>
          <{foreach from=$block.content item=day_data}>
            <{foreach from=$day_data item=data}>
          <td headers="calorie"><{$data.calorie}></td>
            <{/foreach}>
          <{/foreach}>
        </tr>
      <{/if}>
    </table>
  <{else}>
    <table class="table table-striped table-bordered table-hover">
      <thead>
      <tr>
        <th id="lunch_date"><!--日期--><{$smarty.const._MB_TADLUNCH2_LUNCH_DATE}></th>

        <{if "main_food"|in_array:$block.show_cols}>
          <th nowrap="nowrap" id="main_food"><!--主食-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/main_food.png" alt="<{$smarty.const._MB_TADLUNCH2_MAIN_FOOD}>">
            <{$smarty.const._MB_TADLUNCH2_MAIN_FOOD}>
          </th>
        <{/if}>

        <{if "main_dish"|in_array:$block.show_cols}>
          <th nowrap="nowrap" id="main_dish"><!--主菜-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/main_dish.png" alt="<{$smarty.const._MB_TADLUNCH2_MAIN_DISH}>">
            <{$smarty.const._MB_TADLUNCH2_MAIN_DISH}>
          </th>
        <{/if}>

        <{if "side_dish1"|in_array:$block.show_cols}>
          <th nowrap="nowrap" id="side_dish1"><!--副菜1-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/side_dish1.png" alt="<{$smarty.const._MB_TADLUNCH2_SIDE_DISH1}>">
            <{$smarty.const._MB_TADLUNCH2_SIDE_DISH1}>
          </th>
        <{/if}>

        <{if "side_dish2"|in_array:$block.show_cols}>
          <th nowrap="nowrap" id="side_dish2"><!--副菜2-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/side_dish2.png" alt="<{$smarty.const._MB_TADLUNCH2_SIDE_DISH2}>">
            <{$smarty.const._MB_TADLUNCH2_SIDE_DISH2}>
          </th>
        <{/if}>

        <{if "side_dish3"|in_array:$block.show_cols}>
          <th nowrap="nowrap" id="side_dish3"><!--副菜3-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/side_dish3.png" alt="<{$smarty.const._MB_TADLUNCH2_SIDE_DISH3}>">
            <{$smarty.const._MB_TADLUNCH2_SIDE_DISH3}>
          </th>
        <{/if}>

        <{if "fruit"|in_array:$block.show_cols}>
          <th nowrap="nowrap" id="fruit"><!--水果-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/fruit.png" alt="<{$smarty.const._MB_TADLUNCH2_FRUIT}>">
            <{$smarty.const._MB_TADLUNCH2_FRUIT}>
          </th>
        <{/if}>

        <{if "soup"|in_array:$block.show_cols}>
          <th nowrap="nowrap" id="soup"><!--湯點-->
            <img src="<{$xoops_url}>/modules/tad_lunch2/images/soup.png" alt="<{$smarty.const._MB_TADLUNCH2_SOUP}>">
            <{$smarty.const._MB_TADLUNCH2_SOUP}>
          </th>
        <{/if}>

        <{if "calorie"|in_array:$block.show_cols}>
          <th nowrap="nowrap" id="calorie"><!--總熱量--><{$smarty.const._MB_TADLUNCH2_CALORIE}></th>
        <{/if}>
      </tr>
      </thead>

      <tbody>
      <{foreach from=$block.content item=day_data}>
        <{foreach from=$day_data item=data}>
          <tr>
            <th headers="lunch_date" style="text-align:center;">
              <a href="<{$xoops_url}>/modules/tad_lunch2/lunch.php?lunch_data_sn=<{$data.lunch_data_sn}>" class="lunch_block_fancy fancybox.ajax"><{$data.lunch_date}>(<{$data.w}>)</a><br>
              <div><a href="<{$xoops_url}>/modules/tad_lunch2/lunch.php?lunch_data_sn=<{$data.lunch_data_sn}>" class="lunch_block_fancy fancybox.ajax"><{$data.title}></a>
            </th>

            <{if "main_food"|in_array:$block.show_cols}>
              <td headers="main_food"><{$data.main_food}></td>
            <{/if}>

            <{if "main_dish"|in_array:$block.show_cols}>
              <td headers="main_dish"><{$data.main_dish}></td>
            <{/if}>

            <{if "side_dish1"|in_array:$block.show_cols}>
              <td headers="side_dish1"><{$data.side_dish1}></td>
            <{/if}>

            <{if "side_dish2"|in_array:$block.show_cols}>
              <td headers="side_dish2"><{$data.side_dish2}></td>
            <{/if}>

            <{if "side_dish3"|in_array:$block.show_cols}>
              <td headers="side_dish3"><{$data.side_dish3}></td>
            <{/if}>

            <{if "fruit"|in_array:$block.show_cols}>
              <td headers="fruit"><{$data.fruit}></td>
            <{/if}>

            <{if "soup"|in_array:$block.show_cols}>
              <td headers="soup"><{$data.soup}></td>
            <{/if}>

            <{if "calorie"|in_array:$block.show_cols}>
              <td headers="calorie"><{$data.calorie}></td>
            <{/if}>

          </tr>
        <{/foreach}>
      <{/foreach}>
      </tbody>
    </table>
  <{/if}>
  <div class="text-right">
    <a href="<{$xoops_url}>/modules/tad_lunch2" class="btn btn-mini btn-info"><{$smarty.const._MB_TADLUNCH2_BLOCK_SHOW_ALL}></a>
  </div>
<{/if}>