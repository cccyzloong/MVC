{extends file="../_main/document.tpl"}

{block name="body"}
    {if !$controllerExist}
        <div class="alert alert-danger">Controller <strong>{$controller}</strong> not found!</div>
    {/if}

    {if !$actionExist}
        <div class="alert alert-danger">Action <strong>{$action}</strong> in controller <strong>{$controller}</strong> not found!</div>
    {/if}

    {if $actionExist && $controllerExist}
        <div class="alert alert-danger">An error has occurred!</div>
    {/if}

    {if !empty($get)}
        <pre>GET 
            {print_r($get)}
        </pre>
    {/if}

    {if !empty($post)}
        <pre>POST 
            {print_r($post)}
        </pre>
    {/if}
{/block}