<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title><?php if($titulo != NULL){ echo $titulo; ?> | <?php }?>{titulo_padrao}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" />
	    {headerinc}
	    <script type="text/javascript">
	    function alertMessage(classe, msg){
	    	$.notifyBar({ cssClass: classe, html: msg });
	    }
	    </script>
    </head>
    <body>
    <?php if(estaLogado(FALSE)){?>
    <div class="container">
    	
    	<div class="row-fluid cabecalho">
			<div class="pull-left">
				<h1><?php echo '<a href="' . base_url() . '"><img src="' . base_url() . $this->session->userdata("empresa_logo") . '" alt="' . $this->session->userdata("empresa_nome") . '" /></a></h1>'; ?>
			</div>
		</div>
   		{menu}
		<?php }?>
		<div class="row-fluid">
	    	<!-- Tag para colocar conteúdo -->
	    	{conteudo}
	    </div>
	    
	    <div class="row-fluid rodape">
		    <!-- Tag para colocar rodapé -->
		    {rodape}
	    </div>
	     </div>
	    {footerinc}
    </body>
</html>