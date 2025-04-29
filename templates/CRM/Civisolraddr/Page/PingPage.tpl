<ul>
{foreach from=$pingRes key=k item=v}
  {if $v == true}
    <li>{$k} : reachable</li>
  {else}
    <li>{$k} : unreachable</li>
  {/if}
{/foreach}
</ul>
