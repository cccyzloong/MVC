{extends file="../document.tpl"}

{block name="body"}
	We are in {$smarty.template}<br /><br />
	
	<div class="col-lg-12">
		<form method="post" role="form" class="form-horizontal">
			<div class="form-group">
				<label>Firstname</label>
				<input type="text" class="form-control" name="firstname" />
			</div>
			<div class="form-group">
				<label>Lastname</label>
				<input type="text" class="form-control" name="lastname" />
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-default">Send</button>
			</div>
		</form>
	</div>
	
	<div class="col-lg-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Firstname</th>
					<th colspan="2">Lastname</th>
				</tr>
			</thead>
			
			<tbody>
				{foreach from=$data item="user"}
				<tr>
					<td>{$user.id}</td>
					<td>{$user.firstname}</td>
					<td>{$user.lastname}</td>
					<td>
						<form action="/index/delete" method="post" role="form">
							<input type="hidden" name="id" value="{$user.id}" />
							<input type="submit" class="btn btn-danger" value="x" />
						</form>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>

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
	
	{*phpinfo()*}
	{*debug*}

{/block}